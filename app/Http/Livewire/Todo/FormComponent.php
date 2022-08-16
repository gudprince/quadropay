<?php

namespace App\Http\Livewire\Todo;

use Livewire\Component;
use Log;
use App\Http\Requests\TodoFormRequest;
use DB;
use App\Models\Todo;
use Exception;

class FormComponent extends Component
{   
    public $submit_btn_title = "Save Task";
    public $form = [
        "id" => NULL,
        "title" => "",
        "desc" => "",
        "status" => "",
    ];

    public $listeners = [
        "edit" => "edit"
    ];

    public function mount(){

    }
    
    public function edit($todo_id){
        try {
            $this->submit_btn_title = "Update Task";
            $todo = Todo::find($todo_id);           
            $this->form = $todo->toArray();
        } catch (Exception $ex) {
            
        }
    }

    public function save(){
        $form = new TodoFormRequest(); 
        $form->merge($this->form);
        $validated_data = $form->validate($form->rules());
        
        DB::beginTransaction(); 
        try {
            $query = [
                "title" => $validated_data["title"],
                "desc" => $validated_data["desc"],
                "status" => $validated_data["status"],
            ];

            $condition = [
                "id" => $validated_data["id"]
            ];

            $info["todo"] = Todo::updateOrCreate($condition, $query);
            
            DB::commit();
            $info['success'] = TRUE;
        } catch (\Exception $e) {
            DB::rollback();
            $info['success'] = FALSE;
        }


        if($info["success"]){
            $type = "success";
            if($info["todo"]->wasRecentlyCreated){
                $message = "New Task created successfully.";
            }else{
                $message = "Task updated successfully.";
            }

            $this->submit_btn_title = "Save Task";

        }else{
            $type = "error";
            $message = "Something went wrong while saving task.";
        }

        $this->emitTo('todo.todo-notification-component', 'flash_message', $type, $message);

        $this->emitTo('todo.list-component', 'load_list');
    }

    public function render()
    {
        return view('livewire.todo.form-component');
    }
}
