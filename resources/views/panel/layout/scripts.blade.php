<!-- Libs JS -->
<script src="/assets/libs/apexcharts/dist/apexcharts.min.js" defer></script>
<script src="/assets/libs/jsvectormap/dist/js/jsvectormap.min.js" defer></script>
<script src="/assets/libs/jsvectormap/dist/maps/world.js" defer></script>
<script src="/assets/libs/jsvectormap/dist/maps/world-merc.js" defer></script>
<!-- Tabler Core -->
<script src="/assets/js/tabler.min.js" defer></script>
<script src="/assets/js/opai.min.js" defer></script>

<!-- AJAX CALLS -->
<script src="/assets/openai/js/jquery.js"></script>
<script src="/assets/openai/js/main.js"></script>
<script src="/assets/openai/js/toastr.min.js"></script>
<script src="/assets/libs/tom-select/dist/js/tom-select.base.min.js?1674944402" defer></script>


<!-- PAGES JS-->
@guest()
<script src="/assets/js/panel/login_register.js"></script>
@endguest
<script src="/assets/js/panel/search.js"></script>

<script src="/assets/libs/list.js/dist/list.js" defer></script>


<script>
    $(document).ready(function() {
        var isDragging = false;

        $('.selectable').on('mousedown', function(event) {
            $("#selectedtextString").val('');
            // Mark the start of selection
            isDragging = true;
            $(this).addClass('selected');
            $(this).addClass('selected_css');

            // Add mousemove event listener to track drag
            $('.selectable').on('mousemove', function(event) {
                if (isDragging) {
                    $(this).addClass('selected');
                }
            });
        }).on('mouseup', function(event) {
            // End of selection
            isDragging = false;
            $('.selectable').off('mousemove');
            $("#prev_content").text('');
            $("#prev_id").val(0);
            var selectedValues = $('.selected').map(function() {
                return $(this).text();
            }).get();
            let selectedtextString = JSON.stringify(selectedValues);
            $("#selectedtextString").val(selectedtextString);
            $(this).removeClass('selected');
            $(this).removeClass('selected_css');
            showPopup(event.pageX, event.pageY); // Show popup at mouse position
        });

        // Submit button click event handler
        $('#submitButton').click(function() {
            $(".error_msg").removeClass('error_cls');
            $(".success_msg").removeClass('success_cls');
            $(".error_msg").html('');
            $(".success_msg").html('');
            var message = $('#messageInput').val();
            if(!message) {
                $(".error_msg").addClass('error_cls');
                $(".error_msg").html('Please add absence script');
                return false;
            }
           // alert('Message received: ' + message);
            let selectedtextString = $("#selectedtextString").val();
            let prev_id = $("#prev_id").val();
            $.ajax({
               type:'POST',
               url:'/add-google-absense-list',
               data:'_token = <?php echo csrf_token() ?>&message='+message+'&selected_value='+selectedtextString+'&prev_id='+prev_id,
               success:function(data) {
                $('#messageInput').val('');
                $(".success_msg").addClass('success_cls');
                $(".success_msg").html('Script added successfully');
               setTimeout(function() {
                hidePopup();
                location.reload();
               }, 2000);
               }
            });
           
            
        });
    });

    function showPopup(x, y) {
        $('#messagePopup').css({
            'display': 'block',
            'top': y + 'px',
            'left': x + 'px'
        });
    }

    function hidePopup() {
        $(".error_msg").removeClass('error_cls');
        $(".success_msg").removeClass('success_cls');
        $(".error_msg").html('');
        $(".success_msg").html('');
        $('#messagePopup').hide();
    }
    $("#closeButton").click(function(event){
        hidePopup();
    });
    $(".absense_msg").click(function(event){
        let id = $(this).data('id');
        $("#prev_id").val(id);
        $.ajax({
               type:'POST',
               url:'/get-specific-google-absense',
               data:'_token = <?php echo csrf_token() ?>&id='+id,
               success:function(data) {
                $("#prev_content").text(data.content);
                showPopup(event.pageX, event.pageY); 
               }
            });
});
</script>

<style>
    .error_cls {
    color: red;
}
.success_cls {
    color: green;
}
.prev_content {
    color : #000;
}
.selected_css {
    border: 2px dotted #000 !important;
}
span.absense_msg {
    position: relative;
    float: right;
    background-color: #000;
    color: #fff;
    padding: 3px;
}
        /* Optional: Add styling for popup */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #cccccc;
            border-radius: 5px;
            z-index: 1000;
        }
        .popup textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #000;
            box-sizing: border-box;
            box-shadow: none;
            resize: none;
        }
        .popup input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        .popup .submit {
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .popup .close {
            padding: 10px 20px;
            background-color: gray;
            color: #ffffff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>