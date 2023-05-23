let enquery_close = document.querySelector('#enquery_close');
let enquery_wraper = document.querySelector('#enquery_popup-wraper');
let openEnqireBtn = document.querySelector('#openEnqire');

enquery_close.addEventListener('click', ()=>{
    enquery_wraper.style.display = "none";
})

openEnqireBtn.addEventListener('click', ()=>{
    enquery_wraper.style.display = "block";

function getEngqueryData() {
    // chosen_options
    const enqueryDataCost = [];
    const allEnqueryCheckbox = document.querySelectorAll('#enquire-checkbox');
    let totalSelectedCost = 0;
    for(let i=0; i<allEnqueryCheckbox.length; i++) {
        if (allEnqueryCheckbox[i].checked == true){  
            enqueryDataCost.push(allEnqueryCheckbox[i].getAttribute('data-cost'));
        }
    }

    for (let i = 0; i < enqueryDataCost.length; i++) {
        totalSelectedCost += Number(enqueryDataCost[i]);
    }
    
    // update chosen_options in popup
    let chosen_options_tag = document.querySelector('.chosen_options');

    var chosen_options_format = new Intl.NumberFormat(
        'en-GB',
        { 
            style: 'currency',
            currency: 'GBP'
        }
    ).format(totalSelectedCost);

    chosen_options_tag.setAttribute('data-cost', totalSelectedCost);
    chosen_options_tag.innerHTML=chosen_options_format;


    // calculation 
    // subtotal
    let besicPrice = document.querySelector('.basic_price').getAttribute('data-cost');
    let chosen_option = document.querySelector('.chosen_options').getAttribute('data-cost');
    let discount_price = document.querySelector('.discount_price').getAttribute('data-cost');
    let subTotalSetValue = Number(besicPrice) + Number(chosen_option) - Number(discount_price);

    let sub_total_tag = document.querySelector('.sub_total')
    var sub_total_format = new Intl.NumberFormat(
        'en-GB',
        { 
            style: 'currency',
            currency: 'GBP'
        }
    ).format(subTotalSetValue);
    sub_total_tag.setAttribute('data-cost', subTotalSetValue);
    sub_total_tag.innerHTML=sub_total_format;

    

    // vat
    let subtotal = document.querySelector('.sub_total').getAttribute('data-cost');
    let delivery = document.querySelector('.delivery').getAttribute('data-cost');
    let vat_rate_persent = document.querySelector('.vat_rate_persent').getAttribute('data-cost');

    let subtotal_and_delivery =  Number(subtotal) + Number(delivery);
    let vat =  (subtotal_and_delivery/100)*Number(vat_rate_persent); //(num/100)*per
    var vat_tag = document.querySelector('.vat');
    var vat_format = new Intl.NumberFormat(
        'en-GB',
        { 
            style: 'currency',
            currency: 'GBP'
        }
    ).format(vat);
    vat_tag.setAttribute('data-cost', vat);;
    vat_tag.innerHTML=vat_format;

   
    // final price
    let road_fund = document.querySelector('.road_fund').getAttribute('data-cost');
    let first_free = document.querySelector('.first_free').getAttribute('data-cost')
    let FinalPrice = Number(subtotal) + Number(delivery) + Number(vat) + Number(road_fund) + Number(first_free);
    let final_tag =document.querySelector('.final_price');
    var final_format = new Intl.NumberFormat(
        'en-GB',
        { 
            style: 'currency',
            currency: 'GBP'
        }
    ).format(FinalPrice);
    final_tag.setAttribute('data-cost', FinalPrice);
    final_tag.innerHTML=final_format;
    

    //basic price
    let basic_price_tag = document.querySelector('.basic_price');
    let basic_price_value = basic_price_tag.getAttribute('data-cost');
    let format_basic_price = new Intl.NumberFormat(
        'en-GB',
        { 
            style: 'currency',
            currency: 'GBP'
        }
    ).format(basic_price_value);
    basic_price_tag.innerHTML=format_basic_price;


    //discount 
    let discount_tag = document.querySelector('.discount_price');
    let discount_value = discount_tag.getAttribute('data-cost');
    let discount_price_format = new Intl.NumberFormat(
        'en-GB',
        { 
            style: 'currency',
            currency: 'GBP'
        }
    ).format(discount_value);
    discount_tag.innerHTML=discount_price_format;


    //delivery
    let delivery_tag = document.querySelector('.delivery');
    let delivery_value = delivery_tag.getAttribute('data-cost');
    let delivery_price_format = new Intl.NumberFormat(
        'en-GB',
        { 
            style: 'currency',
            currency: 'GBP'
        }
    ).format(delivery_value);
    delivery_tag.innerHTML=delivery_price_format;


    // Road Fund Licence
    let road_fund_tag = document.querySelector('.road_fund');
    let road_fund_value = road_fund_tag.getAttribute('data-cost');
    let road_fund_format = new Intl.NumberFormat(
        'en-GB',
        { 
            style: 'currency',
            currency: 'GBP'
        }
    ).format(road_fund_value);
    road_fund_tag.innerHTML=road_fund_format;

    
    // First Reg Fee
    let first_free_tag = document.querySelector('.first_free');
    let first_free_value = first_free_tag.getAttribute('data-cost');
    let first_free_format = new Intl.NumberFormat(
        'en-GB',
        { 
            style: 'currency',
            currency: 'GBP'
        }
    ).format(first_free_value);
    first_free_tag.innerHTML=first_free_format;

}
getEngqueryData() 

function hiddenValue () {
    // get and show color
    let all_color_options = document.querySelectorAll('.paint-checkbox');
    for(i=0; i<all_color_options.length; i++){
        if (all_color_options[i].checked == true){  
            let selectedColorName = all_color_options[i].getAttribute('value');
            document.querySelector('.hidden_color').setAttribute('value', selectedColorName);
        }
    }

    // options field
    const optionSelected = [];
    const allOptions = document.querySelectorAll('#enquire-checkbox');

    for(let i=0; i<allOptions.length; i++) {
        if (allOptions[i].checked == true){  

            let getSelectdOptionsPrice = allOptions[i].getAttribute('data-cost');

            let formated_option_price = new Intl.NumberFormat(
                'en-GB',
                { 
                    style: 'currency',
                    currency: 'GBP'
                }
            ).format(getSelectdOptionsPrice);
            
            optionSelected.push(`${allOptions[i].getAttribute('value')}: ${formated_option_price}`);

            document.querySelector('.hidden_options').setAttribute('value', optionSelected.join(', '));
        }
    }

}

hiddenValue()
})