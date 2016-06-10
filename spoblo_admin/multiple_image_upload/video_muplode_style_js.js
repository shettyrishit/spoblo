var abc = 0; //Declaring and defining global increement variable

$(document).ready(function() {

//To add new input file field dynamically, on click of "Add More Files" button below function will be executed
    $('#add_more').click(function() {
        var val = $("#file").val();

        if (val == undefined) 
        {
            $(this).before($("<div/>", {id: 'filediv' }).fadeIn('slow').append(
            $("<input/>", {name: 'file[]', type: 'file', id: 'file' })
            ));
        }
        else if (val === '')
        {
            $('#errordiv').show();
            $('#error').text('Please select atlest one video!');
            document.getElementById('video-submit').disabled = true;
            return false;
        }
        else if (!val.match(/(?:mp4|avi|mov|3gp|mpeg)$/)) {
            $('#errordiv').show();
            $('#error').text('Format Not Supported!');
            document.getElementById('video-submit').disabled = true;
            return false;
        }
        else
        {
            $(this).before($("<div/>", {id: 'filediv' }).fadeIn('slow').append(
            $("<input/>", {name: 'file[]', type: 'file', id: 'file' })
            ));
        }   
    });  

//following function will executes on change event of file input to select different file	
$('body').on('change', '#file', function(){

            var val = $("#file").val();
            if (!val.match(/(?:mp4|avi|mov|3gp|mpeg)$/)) {
                    $('#errordiv').show();
                    $('#error').text('Format Not Supported!');
                    //document.getElementById('academywise-video').disabled = true;
                    return false;
            }
            else if (val.size>41943040) 
            {
                $('#errordiv').show();
                $('#error').text('Please upload video less than 40 MB!');
                document.getElementById('video-submit').disabled = true;
                return false;
            }
            else if (this.files && this.files[0]) {
                //document.getElementById('academywise-video').disabled = false;
                abc += 1; //increementing global variable by 1
				
				var z = abc - 1;
                var x = $(this).parent().find('#previewimg' + z).remove();
                $(this).before("<div id='abcd"+ abc +"' class='abcd'><img id='previewimg" + abc + "' src='multiple_image_upload/video.png' style='height: 88px;'/></div>");
             
			   /* var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);*/
               
			    $(this).hide();
                $("#abcd"+ abc).append($("<img/>", {id: 'img', src: 'multiple_image_upload/x.png', alt: 'delete'}).click(function() {
                $(this).parent().remove();
                }));
            }
});

//To preview image     
/*function imageIsLoaded(e) {
    $('#previewimg' + abc).attr('src', e.target.result);
};
*/

    
});