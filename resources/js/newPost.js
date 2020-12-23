 var imgBtn = document.getElementById("add-image-post");
 var postImgBtn = document.getElementById("uploadFile")
 var postImg = document.getElementById('postedImage');
 imgBtn.addEventListener('click', () => postImgBtn.click());
 postImgBtn.onchange = function (event) {
     var item = event.target.files[0];
     console.log(event.target.files);
     var formData = new FormData()
     formData.append("name", item.name)
     formData.append("image", item)
     fetch('https://api.imgur.com/3/image', {
             method: 'POST',
             headers: {
                 Accept: 'application/json',
                 Authorization: 'Client-ID 0bcc5d57e64d7ce'
             },
             body: formData
         })
         .then(data => data.json())
         .then(() => document.getElementById('image_path').src = data.data.link)
 }
