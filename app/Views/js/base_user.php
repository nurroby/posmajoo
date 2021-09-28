<!-- Bootstrap 4.3.1 -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- Admin-LTE 3.1 -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js" integrity="sha256-dVs7YxkIJMdWKIx+E4Z7KGIrsH2P7MHj4WDNvzTzsQU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.full.min.js"
    integrity="sha512-pR0V9qBlotAMIH3xO3alWMVQbC5hd24itpzUYRZ6EU7Qb1cjhjDN4SAtMNrrAvWy83H3zK46lJXu/PulhrIAQA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.16.3/dist/sweetalert2.all.min.js" integrity="sha256-dJtc/tC56+CUFep+WX+wmcSWBPPjSqOSH3Ft+N8YXyc=" crossorigin="anonymous"></script>

<script>
    function maintenance() {
        swal.fire({ 
            title: 'Wait', text: 'This feature will launch soon', type: 'warning',
        });
    }
    function template(data) {
        if ($(data.html).length === 0) {
            return data.text;
        }
        return data.html;
    }
    $("#category_id").select2({
        theme:'bootstrap4',
        placeholder: 'Pilih salah satu',
        ajax: {
            url: '<?= base_url(); ?>/api/category',
            dataType: 'json',
            type: 'GET',
            processResults: function(data) {
                let myResults = [];
                if(data.category.length > 0) {
                    $.each(data.category, function(index, item) {
                        myResults.push({
                            id: item.id,
                            text: item.name.toUpperCase()
                        });
                    });
                }
                return {
                    results: myResults
                };
            },
            cache: true
        },
        allowClear: true,
        placeholder: 'Select at least one element',
        templateResult: template,
        templateSelection: template
    });
    
    $(document).ready(function () {
        $('#category').change(function(){
            if($(this).val()=="category-0"){
                $('.category').show(); return;
            }else{
                $('.category').hide();
            }
            $('.' + $(this).val()).show();
        });
    });

    document.addEventListener('DOMContentLoaded',function(event){
        // array with texts to type in typewriter
        var dataText = [ " monitor your bussiness ", " scale up ", " growth together ", " start ! "];

        // type one text in the typwriter
        // keeps calling itself until the text is finished
        function typeWriter(text, i, fnCallback) {
        // chekc if text isn't finished yet
        if (i < (text.length)) {
            // add next character to h1
            document.querySelector("h1").innerHTML = 'Lets<bold class="bg-maroon" style="border-radius:0 0 0 0;">' + text.substring(0, i+1) +'</bold> with <bold style="color:teal">Majoo</bold><span aria-hidden="true"></span>';

            // wait for a while and call this function again for next character
            setTimeout(function() {
            typeWriter(text, i + 1, fnCallback)
            }, 75);
        }
        // text finished, call callback if there is a callback function
        else if (typeof fnCallback == 'function') {
            // call callback after timeout
            setTimeout(fnCallback, 900);
        }
        }
        // start a typewriter animation for a text in the dataText array
        function StartTextAnimation(i) {
            if (typeof dataText[i] == 'undefined'){
            setTimeout(function() {
                StartTextAnimation(0);
            }, 10000);
            }
            // check if dataText[i] exists
        if (i < dataText[i].length) {
            // text exists! start typewriter animation
            typeWriter(dataText[i], 0, function(){
            // after callback (and whole text has been animated), start next text
            StartTextAnimation(i + 1);
            });
        }
        }
        // start the text animation
        StartTextAnimation(0);
    });

</script>