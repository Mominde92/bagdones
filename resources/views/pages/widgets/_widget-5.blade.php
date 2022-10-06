{{-- List Widget 1 --}}

<div class="card card-custom {{ @$class }}">
    {{-- Header --}}
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-center">Top 5 Items</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm"> </span>
        </h3>
    
    </div>

    {{-- Body --}}
    <div class="card-body pt-8">
    


        {{-- Item --}}
        <div class="d-flex align-items-center mb-2">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">item name</th>
    </tr>
  </thead>
  <tbody>
    @php $i=1; @endphp
    @foreach($topitems as $topitem)
    <tr>
      <th scope="row">{{$i}}</th>
      <td>{{$topitem->name}}</td>
    </tr>
    @php $i++; @endphp
  @endforeach
  
  </tbody>
</table>
        </div>
    </div>
</div>
