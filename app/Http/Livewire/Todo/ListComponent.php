<?php

namespace App\Http\Livewire\Todo;

use Livewire\Component;
use Log;
use App\Models\Todo;
use Livewire\WithPagination;

class ListComponent extends Component
{   
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    
    public $objects =[]; 

    public $paginator = [];

    public $page = 1;

    public $items_per_page = 5;

    public $loading_message = "";

    public $listeners = [
        "load_list" => "loadList"
    ];

    public $filter = [
        "search" => "",
        "status" => "",
        "order_field" => "",
        "order_type" => "",
    ];

    
    public function mount(){
        
    }

    public function loadList(){
        $this->loading_message = "Loading Todos...";

        $query = [];

        if(!empty($this->filter["status"])){
            $query["status"] = $this->filter["status"];
        }

        $objects = Todo::where($query);

        // Search
        if(!empty($this->filter["search"])){
            $filter = $this->filter;
            $objects = $objects->where(function ($query) use ($filter) {
                $query->where('title', 'LIKE', $this->filter['search'] . '%');
            });
        }
        
        // Ordering
        if(!empty($this->filter["order_field"])){
            $order_type = (!empty($this->filter["order_type"]))? $this->filter["order_type"]: 'ASC';
            $objects = $objects->orderBy($this->filter["order_field"], $order_type);
        }

        // Paginating
        return $objects->paginate($this->items_per_page);

      
        
    }

    // Pagination Method
    public function applyPagination($action, $value, $options=[]){
        
        if( $action == "previous_page" && $this->page > 1){
            $this->page-=1;
        }

        if( $action == "next_page" ){
            $this->page+=1;
        }

        if( $action == "page" ){
            $this->page=$value;
        }

        $this->loadList();
    }

    
    public function updatingFilter()
    {
        $this->resetPage();
    }

    public function render()
    {   
        $data = $this->loadList();

        return view('livewire.todo.list-component',['data' =>$data]);
    }
}
