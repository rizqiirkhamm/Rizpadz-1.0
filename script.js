const edit = document.querySelectorAll(".edit");
const editTitle = document.getElementById("edittitle");
const editdesc = document.getElementById("editdesc");
const hiddeninput=document.getElementById("hidden");
const cardBody=document.querySelectorAll(".card-body");
edit.forEach(element => {
    element.addEventListener("click", () => {
        const titleText = element.parentElement.children[0].innerText;
        const descText = element.parentElement.children[1].innerText;
        editTitle.value = titleText;
        editdesc.value = descText;
        hiddeninput.value=element.id;
        console.log(hiddeninput);
    });
});
// let search=document.getElementById("search");
//     search.addEventListener("input",()=>{
//     const value=search.value.toLowerCase();
//     cardBody.forEach(element => {
//         const titleText = element.children[0].innerText.toLowerCase();
//         const descText = element.children[1].innerText.toLowerCase();
//         if(titleText.includes(value)|| descText.includes(value)){
//             element.parentElement.style.display="block";
//         }else {
//             element.parentElement.style.display="none";
//         }
//     });
// });

$(document).ready(function(){
    $('.remove-to-do').click(function(){
        const id = $(this).attr('id');
        
        $.post("app/remove.php", 
              {
                  id: id
              },
              (data)  => {
                 if(data){
                     $(this).parent().hide(600);
                 }
              }
        );
    });

    $(".check-box").click(function(e){
        const id = $(this).attr('data-todo-id');
        
        $.post('app/check.php', 
              {
                  id: id
              },
              (data) => {
                  if(data != 'error'){
                      const h2 = $(this).next();
                      if(data === '1'){
                          h2.removeClass('checked');
                      }else {
                          h2.addClass('checked');
                      }
                  }
              }
        );
    });
});

window.addEventListener("scroll", function(){
    var header = document.querySelector("header");
    header.classList.toggle("sticky", window.scrollY >0)
});



let sections = document.querySelectorAll('section');
let navLinks = document.querySelectorAll('header nav a');

window.onscroll = () => {
    sections.forEach(sec => {
        let top = window.scrollY;
        let offset = sec.offsetTop - 150;
        let height = sec.offsetHeight;
        let id = sec.getAttribute('id');

        if(top >= offset && top < offset + height) {
            navLinks.forEach(links => {
                links.classList.remove('active');
                document.querySelector('header nav a[href*=' + id + ']').classList.add('active');
            });
        };
    });
};
