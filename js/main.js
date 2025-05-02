const loginButton = document.getElementById("lgin");
if(loginButton){
  loginButton.addEventListener("click", function () {
    window.location.href = "../html/login.html";
  });
}

document.querySelector(".logo .txt").addEventListener("click", function(){
  window.location.href = "../html/index.php"
})


document.querySelector(".faqdiv button").addEventListener("click", function(){
  window.location.href = "../html/faqs.php"
})


  document.getElementById("petsAdpt").addEventListener("click", function () {
    window.location.href = "../html/pets.php";
  });


  const imgContainers = document.querySelectorAll('.four .img-container');
  imgContainers.forEach(imgContainer => {
    imgContainer.addEventListener('mouseover', function () {
      document.querySelector('.four .shadowBg').style.backgroundColor = 'rgba(0, 0, 0, 0.4)';
    });
  
    imgContainer.addEventListener('mouseout', function () {
      document.querySelector('.four .shadowBg').style.backgroundColor = ''; 
    });
  });


  const article = document.querySelectorAll('.article-1');
  article.forEach(article => {
    article.addEventListener('mouseover', function () {
      document.querySelector('.article-space .shadowBg').style.backgroundColor = 'rgba(0, 0, 0, 0.4)';
    });
  
    article.addEventListener('mouseout', function () {
      document.querySelector('.article-space .shadowBg').style.backgroundColor = ''; 
    });
  });


  document.querySelector(".four .img-container:nth-child(2)").addEventListener("click",function(){
    window.location.href = "../html/pets.php?type=cat"
  })

  document.querySelector(".four .img-container:nth-child(3)").addEventListener("click",function(){
    window.location.href = "../html/pets.php?type=dog"
  })

  document.querySelector(".four .img-container:nth-child(4)").addEventListener("click",function(){
    window.location.href = "../html/pets.php?type=other"
  })


  document.querySelector(".section2 .grid-container .img-container:nth-child(1)").addEventListener("click", function() {
    window.location.href = "../html/petInfo.php?id=98";
});

  document.querySelector(".section2 .grid-container .img-container:nth-child(2)").addEventListener("click",function(){
    window.location.href = "../html/petInfo.php?id=99"
  })

  document.querySelector(".section2 .grid-container .img-container:nth-child(3)").addEventListener("click",function(){
    window.location.href = "../html/petInfo.php?id=97"
  })

