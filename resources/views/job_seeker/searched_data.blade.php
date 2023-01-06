<div class="table-responsive">
     @foreach($categories as $row)
     <div class="custom-control custom-checkbox">
         <input type="checkbox" class="custom-control-input"
           name="search_location" id={{$row->id}} />
         <label class="custom-control-label" for={{$row->id}}>{{$row->Name}}</label>
       </div>
     @endforeach
    

    {{-- {!! $categories->links() !!} --}}

   </div>