@extends('client.layouts.app') 
@section('content')
<section class="subheader">
    <div class="container">
        <h1>Pending Items</h1>
        <div class="breadcrumb right">Home <i class="fa fa-angle-right"></i> <a href="/" class="current">View Pending Items</a></div>
        <div class="clear"></div>
    </div>
</section>

<section class="module favorited-properties">
    <div class="container">
        <div class="row">
    @include('client.include.user_menu')
            <div class="col-lg-9 col-md-9">
                @if(count($items) == 0)
                <br><br>
                <p class="text-center"><b>The are no pending items.</b></p>
                @else
                <div class="col-sm-6 col-sm-offset-2">
                    <label for="check_all">Select all: </label><input type="checkbox" name="check_all" id="check_all">
                    <input type="submit" id="demo" value="Approve Selected" />
                </div>
                <table class="my-properties-list">
                    <tr>
                        <th>Image</th>
                        <th>Item</th>
                        <th>Approve</th>
                        <th>Date Uploaded</th>
                        <th>Actions</th>
                    </tr>
                    @foreach($items as $item)
                    <tr>
                        <td class="property-img"><a href="{{ asset(json_decode($item->image)[0]) }}"><img src="{{ asset(json_decode($item->image)[0]) }}" alt="" /></a></td>
                        <td class="property-title">
                            <a href="{{ route('items.show', ['slug' => $item->slug]) }}"> {{ $item->category->name }}<span class="flag-icon flag-icon-gr"></span></a><br/>
                            <p class="property-address"><i class="fa fa-user"></i> {{ $item->f_name . ' ' . $item->s_name . ' ' . $item->l_name }}</p>
                            <p class="property-address"><i class="fa fa-id-card"></i> {{ $item->number }}</p>
                        </td>
                        <td class="property-post-status"> <input type="checkbox" name="selected" value="{{ $item->id }}" class=" check_approve"> <span class="button small alt"><i class="fa fa-check icon"><a href='/admin/pending-items/{{$item->id}}/approve' style="color: white">Approve</a> </span></td>
                        <td class="property-date">{{ date("F d, Y", strtotime($item->created_at)) }}</td>
                        {!! Form::open(['action' => ['ItemsController@destroy', $item->slug], 'method' => 'DELETE']) !!}
                        <td class="property-actions">
                            <a href="{{ route('items.show', ['slug' => $item->slug]) }}"><i class="fa fa-eye icon"></i>View</a>
                            <a href="{{ route('items.edit', ['slug' => $item->slug]) }}"><i class="fa fa-pencil icon"></i>Edit</a>
                            <button onClick="javascript: return confirm ('Are you sure you want to delete this item?');" class="btn danger" type="submit"
                                style="color: red"><i class="fa fa-trash icon"></i>Delete</button>
                        </td>
                        {!! Form::close() !!}
                    </tr>
                    @endforeach
                </table>
                <div id="form-container">
                    <form action="/admin/pending-items/approve-multiple" method="post" style="display: none" id="form_1">
                        @csrf
                    </form>
                </div>
                <script>
                    function check() {
                        document.getElementById("myCheck").checked = true;
                    }
                    var checkedValue = $('.messageCheckbox:checked').val();
                </script>

                @if(count($items) > 0)
                    <div class="col-sm-6 col-sm-offset-2">
                        <label for="check_all">Select all: </label><input type="checkbox" name="check_all" id="check_all">
                        <input type="submit" id="demo" value="Approve Selected" />
                    </div>
                @endif
                <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.6.1.min.js"></script>
                <script type="text/javascript">
                    $("#check_all").click(function () {
                        $(".check_approve").prop('checked', $(this).prop('checked'));
                    });
                    var slug = [];
                    $("#demo").live("click", function () {
                        $("input:checkbox[name=selected]:checked").each(function () {
                            slug.push($(this).val());
                        });
                        alert(slug[0]);
                        $form = $("#form_1");
                        $form.append('<textarea name="ids" id="slug_array"></textarea>');
                        $form.append('<input type="submit" id="slug_text" value="Demo" >');
                        $('#form-container').append($form);
                        $("#slug_array").val(JSON.stringify(slug));
                        $form.submit();
                    });
                </script>
                @endif


                <div class="pagination">
                    <div class="center">
                        <ul>
                            {{ $items->links() }}
                        </ul>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
@endsection