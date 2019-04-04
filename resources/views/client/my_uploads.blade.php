@extends('client.layouts.app')
@section('content')
    <section class="subheader">
        <div class="container">
            <h1>Uploaded Documents</h1>
            <div class="breadcrumb right">Home <i class="fa fa-angle-right"></i> <a href="/" class="current">View Your Uploaded Items</a></div>
            <div class="clear"></div>
        </div>
    </section>
  
    <section class="module favorited-properties">
        <div class="container">
            <div class="row">
                @include('client.include.user_menu')
                <div class="col-lg-9 col-md-9">
                    <table class="my-properties-list">
                        <tr>
                            <th>Image</th>
                            <th>Item</th>
                            <th>Upload Status</th>
                            <th>Date Uploaded</th>
                            <th>Actions</th>
                        </tr>
                        <tr>
                            <td class="property-img"><a href="property-single.html"><img src="{{ asset('client/images/property-img4.jpg') }}" alt="" /></a></td>
                            <td class="property-title">
                                <a href="property-single.html">National Id</a><br/>
                                <p class="property-address"><i class="fa fa-user"></i>Jane Doe Smith</p>
                            </td>
                            <td class="property-post-status"><span class="button small alt">Published</span></td>
                            <td class="property-date">2/27/2017</td>
                            <td class="property-actions">
                                <a href="#"><i class="fa fa-eye icon"></i>View</a>
                                <a href="#"><i class="fa fa-pencil icon"></i>Edit</a>
                                <a href="#"><i class="fa fa-close icon"></i>Delete</a>
                            </td>
                        </tr>
                    </table>
                    
                    <div class="pagination">
                        <div class="center">
                            <ul>
                                <li><a href="#" class="button small grey"><i class="fa fa-angle-left"></i></a></li>
                                <li class="current"><a href="#" class="button small grey">1</a></li>
                                <li><a href="#" class="button small grey">2</a></li>
                                <li><a href="#" class="button small grey">3</a></li>
                                <li><a href="#" class="button small grey"><i class="fa fa-angle-right"></i></a></li>
                            </ul>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
@endsection