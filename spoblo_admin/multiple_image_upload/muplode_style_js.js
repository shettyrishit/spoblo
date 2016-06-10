var abc = 0; //Declaring and defining global increement variable

$(document).ready(function() {

//To add new input file field dynamically, on click of "Add More Files" button below function will be executed
    $('#add_more').click(function() {
        var val = $("#file").val();

        if (val == undefined) 
        {
            $(this).before($("<div/>", {id: 'filediv' }).fadeIn('slow').append(
            $("<input/>", {name: 'file[]', type: 'file', id: 'file' , accept: 'image/*'})
            ));
        }
        else if (val === '')
        {
            $('#errordiv').show();
            $('#error').text('Please select atlest one photo!');
            document.getElementById('academywise-gallery').disabled = true;
            return false;
        }
        else if (!val.match(/(?:gif|jpg|png|jpeg)$/)) {
            $('#errordiv').show();
            $('#error').text('Please upload jpeg or png photos!');
            document.getElementById('academywise-gallery').disabled = true;
            return false;
        }
        else
        {
            $(this).before($("<div/>", {id: 'filediv' }).fadeIn('slow').append(
            $("<input/>", {name: 'file[]', type: 'file', id: 'file', accept: 'image/*' })
            ));
        }   
    });  

//following function will executes on change event of file input to select different file	
$('body').on('change', '#file', function(){

            var val = $("#file").val();
            if (!val.match(/(?:gif|jpg|png|jpeg)$/)) {
                    $('#errordiv').show();
                    $('#error').text('Please upload jpeg or png photos!');
                    document.getElementById('academywise-gallery').disabled = true;
                    return false;
            }
            else if (val.size>1024000) 
            {
                $('#errordiv').show();
                $('#error').text('Please upload photo less than 1 MB!');
                document.getElementById('academywise-gallery').disabled = true;
                return false;
            }
            else if (this.files && this.files[0]) {
                document.getElementById('academywise-gallery').disabled = false;
                abc += 1; //increementing global variable by 1
				
				var z = abc - 1;
                var x = $(this).parent().find('#previewimg' + z).remove();
                $(this).before("<div id='abcd"+ abc +"' class='abcd'><img id='previewimg" + abc + "' src=''/></div>");
               
			    var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
               
			    $(this).hide();
                $("#abcd"+ abc).append($("<img/>", {id: 'img', src: 'multiple_image_upload/x.png', alt: 'delete'}).click(function() {
                $(this).parent().remove();
                }));
            }
});

//To preview image     
function imageIsLoaded(e) {
    $('#previewimg' + abc).attr('src', e.target.result);
};


    
});