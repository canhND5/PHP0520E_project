<?php
/**
 * Created by PhpStorm.
 * User: KyThuat88
 * Date: 26/09/2020
 * Time: 2:34 AM
 */
?>
<div style="min-height: 500px">
    <section class="checkout_area section_gap">
        <div class="container">


            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Billing Details</h3>
                        <form class="row contact_form" action="#" method="post" novalidate="novalidate" wtx-context="20E7F394-5BE4-43B8-9F35-962DC0754801">
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="first" name="name" wtx-context="A73F0A6F-0D1D-4048-ACEF-8D13037AB466">
                                <span class="placeholder" data-placeholder="First name"></span>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="last" name="name" wtx-context="F3AD75DA-5CBB-4791-9BFC-199980677794">
                                <span class="placeholder" data-placeholder="Last name"></span>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="company" name="company" placeholder="Company name" wtx-context="C1BC565E-76EE-4E28-8543-6DF4C9354D72">
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="number" name="number" wtx-context="BBD49511-DC01-43C2-8CCD-F5D1D5E45A0C">
                                <span class="placeholder" data-placeholder="Phone number"></span>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="email" name="compemailany" wtx-context="B0816131-209C-40E3-B912-AD3C7A87D4A5">
                                <span class="placeholder" data-placeholder="Email Address"></span>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <select class="country_select" style="display: none;" wtx-context="5F8DF6BD-8C0A-4E33-A244-044C30CACC0A">
                                    <option value="1">Country</option>
                                    <option value="2">Country</option>
                                    <option value="4">Country</option>
                                </select><div class="nice-select country_select" tabindex="0"><span class="current">Country</span><ul class="list"><li data-value="1" class="option selected">Country</li><li data-value="2" class="option">Country</li><li data-value="4" class="option">Country</li></ul></div>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="add1" name="add1" wtx-context="3A83BF67-C973-4E18-8BED-4094588D833B">
                                <span class="placeholder" data-placeholder="Address line 01"></span>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="add2" name="add2" wtx-context="84283550-8932-4F9B-8631-C26CA2AED8A0">
                                <span class="placeholder" data-placeholder="Address line 02"></span>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="city" name="city" wtx-context="569A3639-F5E1-45F6-902C-0485DC828A2E">
                                <span class="placeholder" data-placeholder="Town/City"></span>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <select class="country_select" style="display: none;" wtx-context="5B4F7A05-805F-4A7D-9066-A9B42438900F">
                                    <option value="1">District</option>
                                    <option value="2">District</option>
                                    <option value="4">District</option>
                                </select><div class="nice-select country_select" tabindex="0"><span class="current">District</span><ul class="list"><li data-value="1" class="option selected">District</li><li data-value="2" class="option">District</li><li data-value="4" class="option">District</li></ul></div>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="zip" name="zip" placeholder="Postcode/ZIP" wtx-context="74D5D78B-1923-4E47-8C51-A324E6D9C5DF">
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="creat_account">
                                    <input type="checkbox" id="f-option2" name="selector" wtx-context="B5F5D209-A0F3-4E6E-AA91-803146AEC804">
                                    <label for="f-option2">Create an account?</label>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="creat_account">
                                    <h3>Shipping Details</h3>
                                    <input type="checkbox" id="f-option3" name="selector" wtx-context="ADD2C479-3E7F-4DE8-A20D-832B9E9C7142">
                                    <label for="f-option3">Ship to a different address?</label>
                                </div>
                                <textarea class="form-control" name="message" id="message" rows="1" placeholder="Order Notes"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Your Order</h2>
                            <ul class="list">
                                <li>
                                    <a href="#">Product
                                        <span>Total</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">Fresh Blackberry
                                        <span class="middle">x 02</span>
                                        <span class="last">$720.00</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">Fresh Tomatoes
                                        <span class="middle">x 02</span>
                                        <span class="last">$720.00</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">Fresh Brocoli
                                        <span class="middle">x 02</span>
                                        <span class="last">$720.00</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="list list_2">
                                <li>
                                    <a href="#">Subtotal
                                        <span>$2160.00</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">Shipping
                                        <span>Flat rate: $50.00</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">Total
                                        <span>$2210.00</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="payment_item">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option5" name="selector" wtx-context="C326389F-4FCB-4BAF-8174-1C67665B1404">
                                    <label for="f-option5">Check payments</label>
                                    <div class="check"></div>
                                </div>
                                <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                            </div>
                            <div class="payment_item active">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option6" name="selector" wtx-context="1FB7BE9E-C7FD-48FE-85DF-C9D65C41FBE9">
                                    <label for="f-option6">Paypal </label>
                                    <img src="img/product/single-product/card.jpg" alt="">
                                    <div class="check"></div>
                                </div>
                                <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                            </div>
                            <div class="creat_account">
                                <input type="checkbox" id="f-option4" name="selector" wtx-context="7314CA56-9338-493D-86E3-E5E7FE8EB698">
                                <label for="f-option4">I’ve read and accept the </label>
                                <a href="#">terms &amp; conditions*</a>
                            </div>
                            <a class="main_btn" href="#">Proceed to Paypal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>