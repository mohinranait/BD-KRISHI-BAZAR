
// Select shipping methid js code
var mobilePaymentInput = document.getElementById('mobilePaymentInput');
var cashOnDelevery = document.getElementById('cashOnDelevery');
var paymetnMethidDiv = document.querySelector('.paymetnMethidDiv');
mobilePaymentInput.addEventListener('click',function(){
    paymetnMethidDiv.style.display = "block";
    
})
cashOnDelevery.addEventListener('click',function(){
    paymetnMethidDiv.style.display = "none";

})


// Select paymetn methid
var bkashInput = document.getElementById('bkashInput');
var bkashInfo = document.querySelector('.bkashInfo');
var nagadInput = document.getElementById('nagadInput');
var nagadInfo = document.querySelector('.nagadInfo');

bkashInput.addEventListener('click', function(){
    bkashInfo.style.display = "block";
    nagadInfo.style.display = "none";
})

nagadInput.addEventListener('click',function(){
    nagadInfo.style.display = "block";
    bkashInfo.style.display = "none";
})