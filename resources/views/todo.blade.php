<x-todo>
    <livewire:counter /> 
    <div class="container" >
        <div class="wrapper">
            <div class="title-container">
                <h1 class="title text-center">Laravel Livewire | Todo Application with Sorting, Filtering and Paginating</h1>
            </div>

            <div class="row">
                <div class="col-md-3">

                    @livewire('todo.todo-notification-component') <!-- This component will show notification when todo is saved or updated -->
                
                    @livewire('todo.form-component') <!-- This component will display Todo form -->

                </div>

                <div class="col-md-9">

                    @livewire('todo.list-component') <!-- This component will list Todos -->
            
                </div>
            </div>
        </div>

    </div>
</x-todo>