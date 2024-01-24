//adding service in selectpicker
function addService(SeviceSlug){
    selectedServices = $('.selectpicker').selectpicker('val');
    serviceexist = false;
    if(selectedServices.length >0){
        selectedServices.forEach(element => {
            if(element == SeviceSlug){
                serviceexist = true;
            }
        });
        if(serviceexist == false){
            selectedServices.push(SeviceSlug);
            $('.selectpicker').selectpicker('val',selectedServices);
        }
    }else{
        $('.selectpicker').selectpicker('val',[SeviceSlug]);
    }
}