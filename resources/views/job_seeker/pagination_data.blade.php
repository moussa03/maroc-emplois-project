
<table class="table table-bordered">
  {{-- <thead>
      <tr>
          <th>Title</th>
           
      </tr>
  </thead> --}}
  <tbody>
    
      @foreach ($items as $item)
      <tr>
            <td class="table-category">
            {{-- {{ $item->Name }}  --}}
            <input type="checkbox" id="{{$item->id}}" name="category[]" value={{$item->id}} data-categorie="{{$item->Name}}">
           
            <label for="{{$item->id}}">{{$item->Name}}</label>
           
            </td>
          {{-- <td>{{ $item->description }}</td> --}}
      </tr>
      @endforeach
  </tbody>
  </table>
  
  {!! $items->links() !!}
  {{-- {!! $items->render() !!} --}}