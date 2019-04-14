@extends('client.layouts.app')
@section('content')
    <section class="subheader">
        <div class="container">
            <h1>My Uploaded Documents</h1>
            <div class="breadcrumb right">Home <i class="fa fa-angle-right"></i> <a href="/" class="current">View Your Uploaded Items</a></div>
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
                        <p class="text-center"><b>You have not uploaded any items.</b></p>
                    @else
                        <table class="my-properties-list">
                            <tr>
                                <th>Image</th>
                                <th>Item</th>
                                <th>Upload Status</th>
                                <th>Date Uploaded</th>
                                <th>Actions</th>
                            </tr>
                            @foreach($items as $item)
                                <tr>
                                    <td class="property-img"><a href="{{ asset(json_decode($item->image)[0]) }}"><img src="{{ asset(json_decode($item->image)[0]) }}" alt="" /></a></td>
                                    <td class="property-title">
                                        <a href="{{ route('items.show', ['slug' => $item->slug]) }}"> {{ $item->category }}<span class="flag-icon flag-icon-gr"></span></a><br/>
                                        <p class="property-address"><i class="fa fa-user"></i> {{ $item->f_name . ' ' . $item->s_name . ' ' . $item->l_name }}</p>
                                        <p class="property-address"><i class="fa fa-id-card"></i> {{ $item->number }}</p>
                                    </td>
                                    <td class="property-post-status"><span class="button small {{ $item->approved != null? 'published': 'pending' }}">{{ $item->approved != null? 'Published': 'Pending' }}</span></td>
                                    <td class="property-date">{{ date("F d, Y", strtotime($item->created_at)) }}</td>
                                    {!! Form::open(['action' => ['ItemsController@destroy', $item->slug], 'method' => 'DELETE']) !!}
                                    <td class="property-actions" >
                                            <a href="{{ route('items.show', ['slug' => $item->slug]) }}"><i class="fa fa-eye icon"></i>View</a>
                                            <a href="{{ route('items.edit', ['slug' => $item->slug]) }}"><i class="fa fa-pencil icon"></i>Edit</a>
                                            <button onClick= "javascript: return confirm ('Are you sure you want to delete this item?');" class="btn danger" type="submit" style="color: red"><i class="fa fa-trash icon"></i>Delete</button>
                                        </td>
                                    {!! Form::close() !!}
                                </tr>
                            @endforeach
                                
                        </table>                        
                    @endif
                        
                    
                    <div class="pagination">
                        <div class="center">
                            <ul>
                                {{ $items->links() }}
                            </ul>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
@endsection