function magic()
{
  let container = document.querySelector('.magic-body');
  let screenWidth = window.screen.width;

  try {
    if (container && screenWidth >= 1366) {
      let card = container.querySelector('.not-found-card');
      let title = card.querySelector('.headline');
      let text = card.querySelector('.text-box');
      let btn = card.querySelector('.btn-arr');

      container.addEventListener("mousemove", function(e) {
        let xAxis = (window.innerWidth / 2 - e.pageX)  / 10;
        let yAxis = (window.innerHeight / 2 - e.pageY)  / 10;

        card.style.transform = `rotateY(${xAxis}deg) rotateX(${yAxis}deg)`;
      });

      // In animation
      container.addEventListener("mouseenter", function(){
        setTimeout(function(){
          card.style.transition = 'none';
        }, 750);
          title.style.transform = "translateZ(150px)";
          text.style.transform = "translateZ(55px)";
          btn.style.transform = "translateZ(175px)";
      });
      // Out animation
      container.addEventListener("mouseleave", function(e){
        card.style.transition = 'all 0.5s linear';
        card.style.transform = `rotateY(0deg) rotateX(0deg)`;

        title.style.transform = "translateZ(0px)";
        text.style.transform = "translateZ(0px)";
        btn.style.transform = "translateZ(0px)";
      });
    }
  } catch (e) {
    console.log(e);
  }
}



docReady(function(){
  magic();
});
