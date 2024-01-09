@extends('User.main')
@section('content')
<!-- Offcanvas Overlay -->
<div class="offcanvas-overlay"></div>

<!-- ...:::: Start Breadcrumb Section:::... -->
<div class="breadcrumb-section breadcrumb-bg-color--golden">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <img src="https://static-00.iconduck.com/assets.00/avatar-default-icon-2048x2048-h6w375ur.png"/>
                    <h3 class="breadcrumb-title">Profile</h3>
                    <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                        <nav aria-label="breadcrumb">
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ...:::: End Breadcrumb Section:::... -->

<!-- ...:::: Start Account Dashboard Section:::... -->
<div class="account-dashboard" style="margin-bottom: 50px;margin-top:50px">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <!-- Nav tabs -->
                <div class="dashboard_tab_button" data-aos="fade-up" data-aos-delay="0">
                    <ul role="tablist" class="nav flex-column dashboard-list">
                        <li><a href="#dashboard" data-bs-toggle="tab"
                               class="nav-link btn btn-block btn-md btn-black-default-hover active">Dashboard</a>
                        </li>
                        <li><a href="#address" data-bs-toggle="tab"
                               class="nav-link btn btn-block btn-md btn-black-default-hover">Addresses</a></li>
                        <li><a href="#account-details" data-bs-toggle="tab"
                               class="nav-link btn btn-block btn-md btn-black-default-hover">Account details</a>
                        </li>
                        <li><a href="/logout"
                               class="nav-link btn btn-block btn-md btn-black-default-hover">logout</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">
                <!-- Tab panes -->
                <div class="tab-content dashboard_content" data-aos="fade-up" data-aos-delay="200">
                    <div class="tab-pane fade show active" id="dashboard">
                        <h4>Dashboard </h4>
                        <p>From your account dashboard. you can easily check &amp; view your <a href="#">recent
                                orders</a>, manage your <a href="#">shipping and billing addresses</a> and <a
                                href="#">Edit your password and account details.</a></p>
                    </div>
                    <div class="tab-pane fade" id="orders">
                        <h4>Orders</h4>
                        <div class="table_page table-responsive">
                            <table>
                                <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>May 10, 2018</td>
                                    <td><span class="success">Completed</span></td>
                                    <td>$25.00 for 1 item </td>
                                    <td><a href="cart.html" class="view">view</a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>May 10, 2018</td>
                                    <td>Processing</td>
                                    <td>$17.00 for 1 item </td>
                                    <td><a href="cart.html" class="view">view</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="downloads">
                        <h4>Downloads</h4>
                        <div class="table_page table-responsive">
                            <table>
                                <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Downloads</th>
                                    <th>Expires</th>
                                    <th>Download</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Shopnovilla - Free Real Estate PSD Template</td>
                                    <td>May 10, 2018</td>
                                    <td><span class="danger">Expired</span></td>
                                    <td><a href="#" class="view">Click Here To Download Your File</a></td>
                                </tr>
                                <tr>
                                    <td>Organic - ecommerce html template</td>
                                    <td>Sep 11, 2018</td>
                                    <td>Never</td>
                                    <td><a href="#" class="view">Click Here To Download Your File</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="address">
                        <p>The following addresses will be used on the checkout page by default.</p>
                        <h5 class="billing-address">Billing address</h5>
                        <a href="#" class="view">Edit</a>
                        <p><strong>Bobby Jackson</strong></p>
                        <address>
                            Address: Your address goes here.
                        </address>
                    </div>
                    <div class="tab-pane fade" id="account-details">
                        <h3>Account details </h3>
                        <div class="login">
                            <div class="login_form_container">
                                <div class="account_login_form">
                                    <form action="#">
                                        <p>Already have an account? <a href="#">Log in instead!</a></p>
                                        <div class="input-radio">
                                            <span class="custom-radio"><input type="radio" value="1" {{\Illuminate\Support\Facades\Auth::user()->gioiTinh==1?"checked":""}}
                                                                                  name="id_gender"> Nam</span>
                                            <span class="custom-radio"><input type="radio" value="0" {{\Illuminate\Support\Facades\Auth::user()->gioiTinh==0?"checked":""}}
                                                                              name="id_gender"> Nữ</span>
                                        </div> <br>
                                        <div class="default-form-box mb-20">
                                            <label>Họ</label>
                                            <input type="text" name="first-name" value="{{\Illuminate\Support\Facades\Auth::user()->ho}}">
                                        </div>
                                        <div class="default-form-box mb-20">
                                            <label>Tên</label>
                                            <input type="text" name="last-name" value="{{\Illuminate\Support\Facades\Auth::user()->ten}}">
                                        </div>
                                        <div class="default-form-box mb-20">
                                            <label>Email</label>
                                            <input type="text" name="email-name" value="{{\Illuminate\Support\Facades\Auth::user()->taiKhoan}}">
                                        </div>
{{--                                        <div class="default-form-box mb-20">--}}
{{--                                            <label>Password</label>--}}
{{--                                            <input type="password" name="user-password">--}}
{{--                                        </div>--}}
                                        <div class="default-form-box mb-20">
                                            <label>Sinh nhật</label>
                                            <?php
                                            $ngaySinh = \Illuminate\Support\Facades\Auth::user()->ngaySinh;
                                            $formattedNgaySinh = date('Y-m-d', strtotime($ngaySinh));
                                            ?>
                                            <input type="date" name="birthday" value="{{ $formattedNgaySinh }}">
                                        </div>
                                        <span class="example">
                                                (E.g.: 05/31/1970)
                                            </span>
                                        <br>
{{--                                        <label class="checkbox-default" for="offer">--}}
{{--                                            <input type="checkbox" id="offer">--}}
{{--                                            <span>Receive offers from our partners</span>--}}
{{--                                        </label>--}}
{{--                                        <br>--}}
{{--                                        <label class="checkbox-default checkbox-default-more-text" for="newsletter">--}}
{{--                                            <input type="checkbox" id="newsletter">--}}
{{--                                            <span>Sign up for our newsletter<br><em>You may unsubscribe at any--}}
{{--                                                        moment. For that purpose, please find our contact info in the--}}
{{--                                                        legal notice.</em></span>--}}
{{--                                        </label>--}}
                                        <div class="save_button mt-3">
                                            <button class="btn btn-md btn-black-default-hover"
                                                    type="submit">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Account Dashboard Section:::... -->
@endsection
