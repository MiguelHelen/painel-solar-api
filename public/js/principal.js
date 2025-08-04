// --- Carrossel ---
const carrossel = document.getElementById("carrossel");
const slides = document.querySelectorAll(".slide");
const btnAnterior = document.querySelector(".btn-anterior");
const btnProximo = document.querySelector(".btn-proximo");

let indiceAtual = 0;

function mostrarSlide(index) {
  const largura = slides[0].clientWidth;
  carrossel.style.transform = `translateX(-${index * largura}px)`;
}

btnProximo.addEventListener("click", () => {
  indiceAtual = (indiceAtual + 1) % slides.length;
  mostrarSlide(indiceAtual);
});

btnAnterior.addEventListener("click", () => {
  indiceAtual = (indiceAtual - 1 + slides.length) % slides.length;
  mostrarSlide(indiceAtual);
});


setInterval(() => {
  indiceAtual = (indiceAtual + 1) % slides.length;
  mostrarSlide(indiceAtual);
}, 6000);


const animar = () => {
  const elementos = document.querySelectorAll(".titulo, .recursos, .explorar h2, .card, footer");
  elementos.forEach((el) => {
    el.style.opacity = 0;
    el.style.transform = "translateY(30px)";
  });

  let delay = 0;
  elementos.forEach((el) => {
    setTimeout(() => {
      el.style.transition = "all 0.8s ease-out";
      el.style.opacity = 1;
      el.style.transform = "translateY(0)";
    }, delay);
    delay += 200;
  });
};

window.addEventListener("load", animar);
