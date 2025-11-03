(function(){
const track = document.getElementById('track');
const cards = Array.from(track.children);
const next = document.getElementById('nextBtn');
const prev = document.getElementById('prevBtn');
const dotsWrap = document.getElementById('dots');


let index = 0;
const gap = 18;


cards.forEach((c,i)=>{
const d = document.createElement('button');
d.className='dot';
d.setAttribute('aria-label','Aller au témoignage '+(i+1));
d.addEventListener('click',()=>{ goTo(i); });
dotsWrap.appendChild(d);
});


const dots = Array.from(dotsWrap.children);


function update(){
const cardWidth = cards[0].getBoundingClientRect().width;
const offset = (cardWidth + gap) * index;
track.style.transform = `translateX(-${offset}px)`;
dots.forEach((d,i)=>d.classList.toggle('active', i===index));
}


function goTo(i){ index = Math.max(0, Math.min(i, cards.length-1)); update(); }
next.addEventListener('click',()=> goTo(index+1));
prev.addEventListener('click',()=> goTo(index-1));


document.addEventListener('keydown', e=>{
if(e.key === 'ArrowRight') goTo(index+1);
if(e.key === 'ArrowLeft') goTo(index-1);
});


let autoplay = setInterval(()=>{ goTo((index+1) % cards.length); },4500);
document.querySelector('.carousel').addEventListener('mouseenter', ()=> clearInterval(autoplay));
document.querySelector('.carousel').addEventListener('mouseleave', ()=>{ autoplay = setInterval(()=>{ goTo((index+1) % cards.length); },4500); });


goTo(0);
window.addEventListener('resize', ()=>{ index = Math.min(index, cards.length-1); update(); });
})();