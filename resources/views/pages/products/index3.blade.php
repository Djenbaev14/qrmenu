<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
    /* Create the look of a generic thumbnail */
        .thumbnail {
          position:relative;
          display:inline-block;
          width:6em;
          height:6em;
          border-radius:0.6em;
          border:0.25em solid white;
          vertical-align:middle;
          box-shadow:0 0.15em 0.35em 0.1em rgba(0,0,0,0.2);
          margin:0.5em;
          
          background-position:center;
          background-size:cover;
        }
        
        
        
        /* This will hide the file input */
        .imagepicker input {
          display:none;
        }
        .imagepicker {
          cursor:pointer;
          color:white;
          background-color:rgba(0,0,0,0.3);
        }
        /* This will add the floating plus symbol to the imagepicker */
        .imagepicker:before {
          content:'+';
          position:absolute;
          font-size:3em;
          vertical-align:middle;
          top:50%;
          left:50%;
          transform:translate(-50%,-50%);
        }
        /* This will hide the plus symbol behind the background of the imagepicker if the class "picked" is added to the element */
        .imagepicker.picked:before {
          z-index:-1;
        }
        </style>
</head>
<body>
    
  
  <form enctype="multipart/form-data" method="POST" action="{{route('products.store')}}">
    @csrf
    <div>
      <label class="imagepicker imagepicker-add thumbnail">
        <input type='file' id="imagepicker2" name="photos[]"  multiple="multiple" >
      </label>
    </div>
    <button>add</button>
  </form>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script>
            // This function just works and can be used for many file types.
        // It will accept multiple files, and will only fire the callback once for each file.
        // Don't try to reinvent this
        function readFiles(files, callback, index = 0) {
        if (files && files[0]) {
            let file = files[index++],
            reader = new FileReader();
            reader.onload = function (e) {
            callback(e);
            if (index < files.length) readFiles(files, callback, index);
            };
            reader.readAsDataURL(file);
        }
        }

        // Create a selector for an input and then do whatever you want using the callback function.
        $("body").on("change", ".imagepicker-replace input", function () {
        // store the current "this" into a variable
        var imagepicker = this;
        readFiles(this.files, function (e) {
            // "this" will be different in the callback function
            $(imagepicker)
            .parent()
            .addClass("picked")
            .css({ "background-image": "url(" + e.target.result + ")" });
        });
        });

        // This example will add a new thumbnail each time
        $("body").on("change", ".imagepicker-add input", function () {
        var imagepicker = this;
        readFiles(this.files, function (e) {
            $(imagepicker)
            .parent()
            .before(
                "<div class='thumbnail' style='background-image:url(" +
                e.target.result +
                ")'></div>"
            );
        });
        });

  </script>
  
</body>
</html>