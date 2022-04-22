var addressType = 0;

function changeAddressType(){
    if($('.addressType')[0].checked == true){
        $('.autoAddressForm').hide();
        $('.manualAddressForm').show();
        addressType = 1;
    } else if($('.addressType')[0].checked == false){
        $('.autoAddressForm').show();
        $('.manualAddressForm').hide();
        addressType = 0;
    }
} 

function sendNewOrderForm(){    
    if($('.statuteAcceptStatus')[0].checked == false){
        alert('Musisz zaakceptować regulamin');
        return;
    }

    $('.orderform').submit();
}
