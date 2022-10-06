{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
<style>

.tg-list {
  text-align: center;
  display: flex;
  align-items: center;
}

.tg-list-item {
  margin: 0 2em;
}

h2 {
  color: #777;
}

h4 {
  color: #999;
}

.tgl {
  display: none;
}
.tgl, .tgl:after, .tgl:before, .tgl *, .tgl *:after, .tgl *:before, .tgl + .tgl-btn {
  box-sizing: border-box;
}
.tgl::-moz-selection, .tgl:after::-moz-selection, .tgl:before::-moz-selection, .tgl *::-moz-selection, .tgl *:after::-moz-selection, .tgl *:before::-moz-selection, .tgl + .tgl-btn::-moz-selection {
  background: none;
}
.tgl::selection, .tgl:after::selection, .tgl:before::selection, .tgl *::selection, .tgl *:after::selection, .tgl *:before::selection, .tgl + .tgl-btn::selection {
  background: none;
}
.tgl + .tgl-btn {
  outline: 0;
  display: block;
  width: 4em;
  height: 2em;
  position: relative;
  cursor: pointer;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
}
.tgl + .tgl-btn:after, .tgl + .tgl-btn:before {
  position: relative;
  display: block;
  content: "";
  width: 50%;
  height: 100%;
}
.tgl + .tgl-btn:after {
  left: 0;
}
.tgl + .tgl-btn:before {
  display: none;
}
.tgl:checked + .tgl-btn:after {
  left: 50%;
}

.tgl-light + .tgl-btn {
  background: #f0f0f0;
  border-radius: 2em;
  padding: 2px;
  transition: all 0.4s ease;
}
.tgl-light + .tgl-btn:after {
  border-radius: 50%;
  background: #fff;
  transition: all 0.2s ease;
}
.tgl-light:checked + .tgl-btn {
  background: #9FD6AE;
}

.tgl-ios + .tgl-btn {
  background: #fbfbfb;
  border-radius: 2em;
  padding: 2px;
  transition: all 0.4s ease;
  border: 1px solid #e8eae9;
}
.tgl-ios + .tgl-btn:after {
  border-radius: 2em;
  background: #fbfbfb;
  transition: left 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), padding 0.3s ease, margin 0.3s ease;
  box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.1), 0 4px 0 rgba(0, 0, 0, 0.08);
}
.tgl-ios + .tgl-btn:hover:after {
  will-change: padding;
}
.tgl-ios + .tgl-btn:active {
  box-shadow: inset 0 0 0 2em #e8eae9;
}
.tgl-ios + .tgl-btn:active:after {
  padding-right: 0.8em;
}
.tgl-ios:checked + .tgl-btn {
  background: #86d993;
}
.tgl-ios:checked + .tgl-btn:active {
  box-shadow: none;
}
.tgl-ios:checked + .tgl-btn:active:after {
  margin-left: -0.8em;
}

.tgl-skewed + .tgl-btn {
  overflow: hidden;
  transform: skew(-10deg);
  -webkit-backface-visibility: hidden;
          backface-visibility: hidden;
  transition: all 0.2s ease;
  font-family: sans-serif;
  background: #888;
}
.tgl-skewed + .tgl-btn:after, .tgl-skewed + .tgl-btn:before {
  transform: skew(10deg);
  display: inline-block;
  transition: all 0.2s ease;
  width: 100%;
  text-align: center;
  position: absolute;
  line-height: 2em;
  font-weight: bold;
  color: #fff;
  text-shadow: 0 1px 0 rgba(0, 0, 0, 0.4);
}
.tgl-skewed + .tgl-btn:after {
  left: 100%;
  content: attr(data-tg-on);
}
.tgl-skewed + .tgl-btn:before {
  left: 0;
  content: attr(data-tg-off);
}
.tgl-skewed + .tgl-btn:active {
  background: #888;
}
.tgl-skewed + .tgl-btn:active:before {
  left: -10%;
}
.tgl-skewed:checked + .tgl-btn {
  background: #86d993;
}
.tgl-skewed:checked + .tgl-btn:before {
  left: -100%;
}
.tgl-skewed:checked + .tgl-btn:after {
  left: 0;
}
.tgl-skewed:checked + .tgl-btn:active:after {
  left: 10%;
}

.tgl-flat + .tgl-btn {
  padding: 2px;
  transition: all 0.2s ease;
  background: #fff;
  border: 4px solid #f2f2f2;
  border-radius: 2em;
}
.tgl-flat + .tgl-btn:after {
  transition: all 0.2s ease;
  background: #f2f2f2;
  content: "";
  border-radius: 1em;
}
.tgl-flat:checked + .tgl-btn {
  border: 4px solid #7FC6A6;
}
.tgl-flat:checked + .tgl-btn:after {
  left: 50%;
  background: #7FC6A6;
}

.tgl-flip + .tgl-btn {
  padding: 2px;
  transition: all 0.2s ease;
  font-family: sans-serif;
  perspective: 100px;
}
.tgl-flip + .tgl-btn:after, .tgl-flip + .tgl-btn:before {
  display: inline-block;
  transition: all 0.4s ease;
  width: 100%;
  text-align: center;
  position: absolute;
  line-height: 2em;
  font-weight: bold;
  color: #fff;
  position: absolute;
  top: 0;
  left: 0;
  -webkit-backface-visibility: hidden;
          backface-visibility: hidden;
  border-radius: 4px;
}
.tgl-flip + .tgl-btn:after {
  content: attr(data-tg-on);
  background: #02C66F;
  transform: rotateY(-180deg);
}
.tgl-flip + .tgl-btn:before {
  background: #FF3A19;
  content: attr(data-tg-off);
}
.tgl-flip + .tgl-btn:active:before {
  transform: rotateY(-20deg);
}
.tgl-flip:checked + .tgl-btn:before {
  transform: rotateY(180deg);
}
.tgl-flip:checked + .tgl-btn:after {
  transform: rotateY(0);
  left: 0;
  background: #7FC6A6;
}
.tgl-flip:checked + .tgl-btn:active:after {
  transform: rotateY(20deg);
}
</style>


<div class="card card-custom example example-compact">
    <div class="card-header">
        <h3 class="card-title">
            Edit Attribute
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <a href="{{ url('attribute') }}" class="btn btn-secondary">Go Back</a>
            </div>
        </div>
    </div>
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!--begin::Form-->
    <form action="{{ url('attribute/update',$attribute) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group row">

                <div class="col-lg-6">
                    <label>Name_en<span class="text-danger">*</span></label>
                    <input type="text" name="name" required class="form-control" placeholder="Enter Name"
                        value="{{ $attribute->name }}" />
                    <span class="form-text text-muted">Please enter Name, Max 50 character allowed</span>
                </div>
                <div class="col-lg-6">
                    <label>Name_locale</label>
                    <input type="text" name="name_locale" required class="form-control" placeholder="Enter Local Name"
                        value="{{ $attribute->name_locale }}" />
                    <span class="form-text text-muted">Please enter Local Name, Max 50 character allowed</span>
                </div>


               

                <!-- <div class="col-lg-6">
                    <label>Description<span class="text-danger">*</span></label>
                    <input type="text" name="description"  class="form-control"
                        placeholder="Enter description" />
                    <span class="form-text text-muted">Please enter description, Max 50 character allowed</span>
                </div>
                <div class="col-lg-6">
                    <label>Description_locale</label>
                    <input type="text" name="description_locale" class="form-control"
                        placeholder="Enter Local Description locale" />
                    <span class="form-text text-muted">Please enter Locale Description, Max 50 character allowed</span>
                </div> -->




            </div>
            <!-- Attribute Component -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Attribute Components</h4>
                    <div class="component-info">
                        @if($attribute->entries()->count() > 0)
                            @foreach( $attribute->entries as $index=>$entry )

                                <div class="row form-row component-cont">
                                    <div class="col-12 col-md-10 col-lg-11">
                                        <div class="row form-row">
                                            <div class="col-12 col-md-3 col-lg-3">
                                                <div class="form-group">
                                                    <label>Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="entry_name[]" value="{{ $entry->name }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3 col-lg-3">
                                                <div class="form-group">
                                                    <label>Name Locale <span class="text-danger">*</span></label>
                                                    <input type="text" name="entry_name_locale[]"
                                                        value="{{ $entry->name_locale }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3 col-lg-3">
                                                <div class="form-group">
                                
                                        <div class="custom-control custom-switch">
                                        <h4>Is Active <span class="text-danger">*</span></h4>
                                        <input class="tgl tgl-light" id="check{{$entry->name}}" name="check{{$entry->name}}" type="checkbox" @if($entry->is_active == '1')checked @else
                                         @endif />
                                        <label class="tgl-btn" for="check{{$entry->name}}"></label>                         
                                         </div>
                                         </div>
                                         </div>


                                    @if( $index > 0)
                                        <div class="col-12 col-md-2 col-lg-1"><label
                                                class="d-md-block d-sm-none d-none">&nbsp;</label><a href="#"
                                                class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div>
                                    @endif
                                </div>
                            @endforeach
                       
                  
                            
                        @else        
                        <div class="row form-row component-cont">
                            <div class="col-12 col-md-10 col-lg-11">
                                <div class="row form-row">
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label> Name <span class="text-danger">*</span></label>
                                            <input type="text" required name="entry_name[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>Name locale <span class="text-danger">*</span></label>
                                            <input type="text" required name="entry_name_locale[]" class="form-control">
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        @endif
                    </div>
                    <div class="add-more">
                        <a href="javascript:void(0);" class="add-component"><i class="fa fa-plus-circle"></i> Add more
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Attribute Component -->

        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-8">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>
    </form>
    <!--end::Form-->
</div>

@endsection
{{-- Scripts Section --}}
@section('scripts')
<script>
    $(".component-info").on('click', '.trash', function () {
        $(this).closest('.component-cont').remove();
        return false;
    });

    $(".add-component").on('click', function () {

        var component_content = '<div class="row form-row component-cont">' +
            '<div class="col-12 col-md-10 col-lg-11">' +
            '<div class="row form-row">' +
            '<div class="col-12 col-md-6 col-lg-4">' +
            '<div class="form-group">' +
            '<label> Name </label>' +
            '<input type="text" required name="entry_name[]" class="form-control">' +
            '</div>' +
            '</div>' +
            '<div class="col-12 col-md-6 col-lg-4">' +
            '<div class="form-group">' +
            '<label> Name locale </label>' +
            '<input type="text" required name="entry_name_locale[]" class="form-control">' +
            '</div>' +
            '</div>' +

            '</div>' +
            '</div>' +
            '<div class="col-12 col-md-2 col-lg-1"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div>' +
            '</div>';

        $(".component-info").append(component_content);
    });

</script>
@endsection
