@extends('Layout.app')
@section('content')

<style>
@import url(https://fonts.googleapis.com/css?family=Lato:400, 700,300);

#amount {
  font-size: 12px;
}

#amount strong {
  font-size: 14px;
}

#card-back {
  top: 40px;
  right: 0;
  z-index: -2;
}

#card-btn {
  background-color: rgba(251, 251, 251, 0.8);
  color: #ffb242;
  position: absolute;
  bottom: -55px;
  right: 0;
  width: 150px;
  border-radius: 8px;
  height: 42px;
  font-size: 12px;
  font-family: lato, 'helvetica-light', 'sans-serif';
  text-transform: uppercase;
  letter-spacing: 1px;
  font-weight: 400;
  outline: none;
  border: none;
  cursor: pointer;
}

#card-btn:hover {
  background-color: rgba(251, 251, 251, 1);
}

#card-cvc {
  width: 60px;
  margin-bottom: 0;
}

#card-front,
#card-back {
  position: absolute;
  background-color: #498ee4;
  width: 390px;
  height: 250px;
  border-radius: 6px;
  padding: 20px 30px 0;
  box-sizing: border-box;
  font-size: 10px;
  letter-spacing: 1px;
  font-weight: 300;
  color: white;
}

#card-image {
  float: right;
  height: 100%;
}

#card-image i {
  font-size: 40px;
}

#card-month {
  width: 45% !important;
}

#card-number,
#card-holder {
  width: 100%;
}

#card-stripe {
  width: 100%;
  height: 55px;
  background-color: #3d5266;
  position: absolute;
  right: 0;
}

#card-success {
  color: #00b349;
}

#card-token {
  display: none;
}

#card-year {
  width: 45%;
  float: right;
}

#cardholder-container {
  width: 60%;
  display: inline-block;
}

#cvc-container {
  position: absolute;
  width: 110px;
  right: -115px;
  bottom: -10px;
  padding-left: 20px;
  box-sizing: border-box;
}

#cvc-container label {
  width: 100%;
}

#cvc-container p {
  font-size: 6px;
  text-transform: uppercase;
  opacity: 0.6;
  letter-spacing: .5px;
}

#form-container {
  margin: auto;
  width: 500px;
  height: 290px;
  position: relative;
}

#form-errors {
  color: #eb0000;
}

#form-errors,
#card-success {
  background-color: white;
  width: 500px;
  margin: 0 auto 10px;
  height: 50px;
  border-radius: 8px;
  padding: 0 20px;
  font-weight: 400;
  box-sizing: border-box;
  line-height: 46px;
  letter-spacing: .5px;
  text-transform: none;
}

#form-errors p,
#card-success p {
  margin: 0 5px;
  display: inline-block;
}

#exp-container {
  margin-left: 10px;
  width: 32%;
  display: inline-block;
  float: right;
}

.hidden {
  display: none;
}

#image-container {
  width: 100%;
  position: relative;
  height: 55px;
  margin-bottom: 5px;
  line-height: 55px;
}

#image-container img {
  position: absolute;
  right: 0;
  top: 0;
}

input {
  border: none;
  outline: none;
  background-color: #5a9def;
  height: 30px;
  line-height: 30px;
  padding: 0 10px;
  margin: 0 0 25px;
  color: white;
  font-size: 10px;
  box-sizing: border-box;
  border-radius: 4px;
  font-family: lato, 'helvetica-light', 'sans-serif';
  letter-spacing: .7px;
}

input::-webkit-input-placeholder {
  color: #fff;
  opacity: 0.7;
  font-family: lato, 'helvetica-light', 'sans-serif' letter-spacing: 1px;
  font-weight: 300;
  letter-spacing: 1px;
  font-size: 10px;
}

input:-moz-placeholder {
  color: #fff;
  opacity: 0.7;
  font-family: lato, 'helvetica-light', 'sans-serif' letter-spacing: 1px;
  font-weight: 300;
  letter-spacing: 1px;
  font-size: 10px;
}

input::-moz-placeholder {
  color: #fff;
  opacity: 0.7;
  font-family: lato, 'helvetica-light', 'sans-serif' letter-spacing: 1px;
  font-weight: 300;
  letter-spacing: 1px;
  font-size: 10px;
}

input:-ms-input-placeholder {
  color: #fff;
  opacity: 0.7;
  font-family: lato, 'helvetica-light', 'sans-serif' letter-spacing: 1px;
  font-weight: 300;
  letter-spacing: 1px;
  font-size: 10px;
}

input.invalid {
  border: solid 2px #eb0000;
  height: 34px;
}

label {
  display: block;
  margin: 0 auto 7px;
}

#shadow {
  position: absolute;
  right: 0;
  width: 284px;
  height: 214px;
  top: 36px;
  background-color: #000;
  z-index: -1;
  border-radius: 8px;
  box-shadow: 3px 3px 0 rgba(0, 0, 0, 0.1);
  -moz-box-shadow: 3px 3px 0 rgba(0, 0, 0, 0.1);
  -webkit-box-shadow: 3px 3px 0 rgba(0, 0, 0, 0.1);
}
</style>
<section class="dashboard">
 <div class="container">
<div id="card-success" class="hidden">
  <i class="fa fa-check"></i>
  <p>Payment Successful!</p>
</div>
<div id="form-errors" class="hidden">
  <i class="fa fa-exclamation-triangle"></i>
  <p id="card-error">Card error</p>
</div>
<div id="form-container">

  <div id="card-front">
    <div id="shadow"></div>
    <div id="image-container">
      <span id="amount">paying: <strong>$99</strong></span>
      <span id="card-image">
      
        </span>
    </div>
    <!--- end card image container --->

    <label for="card-number">
        Card Number
      </label>
    <input type="text" id="card-number" placeholder="1234 5678 9101 1112" length="16">
    <div id="cardholder-container">
      <label for="card-holder">Card Holder
      </label>
      <input type="text" id="card-holder" placeholder="e.g. John Doe" />
    </div>
    <!--- end card holder container --->
    <div id="exp-container">
      <label for="card-exp">
          Expiration
        </label>
      <input id="card-month" type="text" placeholder="MM" length="2">
      <input id="card-year" type="text" placeholder="YY" length="2">
    </div>
        <div id="cvc-container">
      <label for="card-cvc"> CVC/CVV</label>
      <input id="card-cvc" placeholder="XXX-X" type="text" min-length="3" max-length="4">
      <p>Last 3 or 4 digits</p>
    </div>
    <!--- end CVC container --->
    <!--- end exp container --->
  </div>
  <!--- end card front --->
  <div id="card-back">
    <div id="card-stripe">
    </div>

  </div>
  <!--- end card back --->
  <input type="text" id="card-token" />
  <button type="button" id="card-btn" >Submit</button>

</div>
<div style="margin-bottom:210px"></div>
</div>
</section>

<!--- end form container --->

@section('scripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="https://use.fontawesome.com/f1e0bf0cbc.js"></script>

<script>
$(document).ready(function () {

Stripe.setPublishableKey('pk_test_9D43kM3d2vEHZYzPzwAblYXl');

var cardNumber, cardMonth, cardYear, cardCVC, cardHolder;

// check for any empty inputs
function findEmpty() {
    var emptyText = $('#form-container input').filter(function () {

        return $(this).val == null;
    });

    // add invalid class to empty inputs
    console.log(emptyText.prevObject);
    emptyText.prevObject.addClass('invalid');
}



// check card type on card number input blur 
$('#card-number').blur(function (event) {
    event.preventDefault();
    checkCardType();
});

// on button click: 
$('#card-btn').click(function (event) {

    // get each input value and use Stripe to determine whether they are valid
    var cardNumber = $('#card-number').val();
    var isValidNo = Stripe.card.validateCardNumber(cardNumber);
    var expMonth = $('#card-month').val();
    var expYear = $('#card-year').val();
    var isValidExpiry = Stripe.card.validateExpiry(expMonth, expYear);
    var cardCVC = $('#card-cvc').val();
    var isValidCVC = Stripe.card.validateCVC(cardCVC);
    var cardHolder = $('#card-holder').val();
    event.preventDefault();

    // alert the user if any fields are missing
    if (!cardNumber || !cardCVC || !cardHolder || !expMonth || !expYear) {
        console.log(cardNumber + cardCVC + cardHolder + cardMonth + cardYear);
        $('#form-errors').addClass('hidden');
        $('#card-success').addClass('hidden');
        $('#form-errors').removeClass('hidden');
        $('#card-error').text('Please complete all fields.');
        findEmpty();
    } else {

        // alert the user if any fields are invalid
        if (!isValidNo || !isValidExpiry || !isValidCVC) {
            $('#form-errors').css('display', 'block');
            if (!isValidNo) {
                $('#card-error').text('Invalid credit card number.');
            } else if (!isValidExpiry) {
                $('#card-error').text('Invalid expiration date.')
            } else if (!isValidCVC) {
                $('#card-error').text('Invalid CVC code.')
            }

        } else {
          //Go to my register
            $('#card-success').removeClass('hidden');
        }
    }
})

});
</script>
@stop
@endsection


