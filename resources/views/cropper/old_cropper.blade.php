<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image cropper</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.css" integrity="sha512-C4k/QrN4udgZnXStNFS5osxdhVECWyhMsK1pnlk+LkC7yJGCqoYxW4mH3/ZXLweODyzolwdWSqmmadudSHMRLA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .page{
            margin:1em auto;
            max-width:768px;
            display:flex;
            align-items:flex-start;
            flex-wrap: wrap;
            height: 100%;
        }
        .box{
            padding:0.5em;
            width:100%;
            margin:0.5em;
        }
        .box-2{
            padding:0.5em;
            width:calc(100% 2 -1em);
        }
        .options label,.options input{
            /* width:4em; */
            padding:0.5em 1em;
        }

        .hide{
            display: none;
        }
        img{
            max-width:100%;
        }

    </style>

</head>
<body>

         <input class="form-file-input form-control" type="file" id="file-input" required accept="image/*" name="image">


         <div class="row">
            <div class="col-12">
                <div class="result">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
            <div class="box-2 img-result hide text-center">
                    <img src="" alt="" class="cropped">
            </div>
            </div>
        </div>

        <div class="row">

                    <div class="options hide">
                        <br>
                            <label for="width" class="col-3  text-center">width:</label>
                            <input type="number" class="img-w " value="300" min="100" max="1200"
                            >
                            <button class=" save hide btn btn-primary btn-sm col-3 offset-1">save</button>
                    </div>

        </div>
        <!-- <div class="row ">
                <div class="col-6 offset-1">
                    <button class=" save hide btn btn-primary btn-sm">save</button>
                </div>
                <div class="col-6">
                   <a href=""class="btn download hide">download</a>
                </div>
        </div> -->



    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js" integrity="sha512-6lplKUSl86rUVprDIjiW8DuOniNX8UDoRATqZSds/7t6zCQZfaCe3e5zcGaQwxa8Kpn5RTM9Fvl3X2lLV4grPQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        let result=document.querySelector(".result");
        let img_result=document.querySelector(".img-result");
        let img_w=document.querySelector(".img-w");
        let img_h=document.querySelector(".img-h");
        let options=document.querySelector(".options");
        let save=document.querySelector(".save");
        let cropped=document.querySelector(".cropped");
        let dwn=document.querySelector(".download");
        let upload=document.querySelector("#file-input");
        let cropper="";
        upload.addEventListener('change',(e)=>{
            console.log(e);
            const reader=new FileReader();
            reader.onload=(e)=>{
                if(e.target.result){
                    //create new image
                    let img=document.createElement('img');
                    img.id="image";
                    img.src=e.target.result;
                    //clean result before
                    result.innerHTML="";
                    //append new image
                    result.appendChild(img);
                    //show save btn and options
                    save.classList.remove('hide');
                    options.classList.remove('hide');
                    //init cropper
                    cropper=new Cropper(img);
                }
            }
            reader.readAsDataURL(e.target.files[0]);
        });

        save.addEventListener('click',(e)=>{
            e.preventDefault()
            let imgSrc=cropper.getCroppedCanvas({
                width:img_w.value,
            }).toDataURL();
            console.log(imgSrc);
            cropped.classList.remove('hide');
            img_result.classList.remove('hide');
            //show image cropped
            cropped.src=imgSrc;
            dwn.classList.remove('hide');
            dwn.download="imagename.png";
            dwn.setAttribute('href',imgSrc);
        });
    </script>
</body>
</html>
