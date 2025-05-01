document.getElementById("lgin").addEventListener("click", function () {
    window.location.href = "../html/login.html";
  });

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

