var postImgBtn = document.getElementById("uploadFile")
document.getElementById("add-image-post").addEventListener('click', () => postImgBtn.click());






// postImgBtn.onchange = function (event) {
//     var item = event.target.files[0];
//     console.log(event.target.files);
//     var formData = new FormData()
//     formData.append("name", item.name)
//     formData.append("image", item)
//     fetch('https://api.imgur.com/3/', {
//             method: 'POST',
//             headers: {
//                 Accept: 'application/json',
//                 Authorization: 'Client-ID 5f2b0d7d20711dd'
//             },
//             body: formData
//         })
//         .then(data => data.json())
//         .then(function (data) {
//                 document.getElementById('image_path').src = data.data.link;
//             }

//         )
// }
