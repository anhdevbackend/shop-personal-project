$(document).ready(function() {

    $('.btn-plus').click(function() {
        $parentNote = $(this).parents('tr');
        $onePrice = $parentNote.find('#Price').text().replace('Kyats', '');
        $oneQuantity = Number($parentNote.find('#Qtantity').val());
        $total = $onePrice * $oneQuantity;
        // ပစ္စည်းတစ်ခုစီ၏‌ အရေအတွက်အလိုက် ဇျေးနှုန်း
        $totalPrice = $parentNote.find('#Total').html($total + 'Kyats');

        finalSummary();

    });

    $('.btn-minus').click(function() {
        $parentNote = $(this).parents('tr');
        $onePrice = $parentNote.find('#Price').text().replace('Kyats', '');
        $oneQuantity = Number($parentNote.find('#Qtantity').val());
        $total = $onePrice * $oneQuantity;
        $totalPrice = $parentNote.find('#Total').html($total + 'Kyats');

        finalSummary();
    });

    $('.remove_btn').click(function() {
        $parentNote = $(this).parents('tr');
        $parentNote.remove();

        finalSummary();
    });

    function finalSummary() {
        $totalSummary = 0;
        $('tbody tr').each(function(index, row) {
            // console.log($(row).find('#Total').text().replace('Kyats',''));
            $totalSummary += Number($(row).find('#Total').text().replace('Kyats', ''));
        });
        // ပစ္စည်းတစ်ခုစီ၏‌ အရေအတွက်အလိုက် ဇျေးနှုန်းများပေါင်းလဒ်
        $('#Subtotal').html($totalSummary);
        // ဇျေးနှုန်းများပေါင်းလဒ် + ၀န်ဆောင်ခ
        $('#finalPrice').html($totalSummary + 2000 + 'Kyats');

        // Subtotal တန်ဖိုး '0' ြဖစ်သွားလျှင် FinalPrice တန်ဖိုးပါ '0' ြဖစ်
        if (Number($('#Subtotal').text()) == 0) {
            $('#finalPrice').html(0 + 'Kyats');
        }
    }
});