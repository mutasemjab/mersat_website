/* LOADER */
const lf=document.getElementById('lf'),lp=document.getElementById('lp'),ld=document.getElementById('loader');
let p=0;
const lt=setInterval(()=>{p+=Math.random()*16+5;if(p>=100){p=100;clearInterval(lt);setTimeout(()=>ld.classList.add('out'),400);}lf.style.width=Math.min(p,100)+'%';lp.textContent=Math.floor(Math.min(p,100))+'%';},100);

/* CURSOR */
const c1=document.getElementById('cur'),c2=document.getElementById('cur2');
let mx=0,my=0,tx=0,ty=0;
document.addEventListener('mousemove',e=>{mx=e.clientX;my=e.clientY;c1.style.left=mx+'px';c1.style.top=my+'px';});
(function loop(){tx+=(mx-tx)*.14;ty+=(my-ty)*.14;c2.style.left=tx+'px';c2.style.top=ty+'px';requestAnimationFrame(loop);})();

/* NAV */
const nav=document.getElementById('nav');
window.addEventListener('scroll',()=>{nav.classList.toggle('stuck',scrollY>60);document.getElementById('stt').classList.toggle('show',scrollY>400);});

/* REVEAL */
const revs=document.querySelectorAll('.r');
revs.forEach(el=>new IntersectionObserver(([e])=>{if(e.isIntersecting){e.target.classList.add('v');}},{threshold:.08}).observe(el));

/* COUNTERS */
document.querySelectorAll('[data-t]').forEach(el=>{
  new IntersectionObserver(([e])=>{
    if(!e.isIntersecting)return;
    const t=parseInt(el.dataset.t);let n=0;
    const ti=setInterval(()=>{n=Math.min(n+t/55,t);el.textContent=Math.floor(n);if(n>=t)clearInterval(ti);},28);
  },{threshold:.5}).observe(el);
});

/* HOVER VIDEOS on portfolio */
document.querySelectorAll('.pg-item').forEach(item=>{
  const v=item.querySelector('.pg-vid');if(!v)return;
  item.addEventListener('mouseenter',()=>v.play());
  item.addEventListener('mouseleave',()=>{v.pause();v.currentTime=0;});
});

/* HERO VIDEO */
const hv=document.getElementById('hero-vid');
if(hv){
  hv.addEventListener('canplay',()=>hv.classList.add('loaded'));
  hv.play().catch(()=>{hv.load();hv.play().catch(()=>{});});
  if(hv.readyState>=3)hv.classList.add('loaded');
}

/* SMOOTH SCROLL */
document.querySelectorAll('a[href^="#"]').forEach(a=>{
  a.addEventListener('click',e=>{
    const id=a.getAttribute('href');
    if(id.length<2)return;
    let t=null;try{t=document.querySelector(id);}catch(err){}
    if(t){e.preventDefault();t.scrollIntoView({behavior:'smooth'});}
  });
});

/* CONTACT FORM (falls back to a normal POST when JavaScript is unavailable) */
const cform=document.getElementById('contact-form');
if(cform){
  const btn=document.getElementById('sbtn'),msg=document.getElementById('form-msg');
  const show=(text,ok)=>{msg.textContent=text;msg.className='form-msg '+(ok?'ok':'err');};
  cform.addEventListener('submit',async e=>{
    e.preventDefault();
    btn.disabled=true;btn.textContent=cform.dataset.sending;
    try{
      const res=await fetch(cform.action,{method:'POST',body:new FormData(cform),headers:{'Accept':'application/json','X-Requested-With':'XMLHttpRequest'}});
      const data=await res.json().catch(()=>({}));
      if(res.ok){show(data.message,true);cform.reset();}
      else if(res.status===422&&data.errors){show(Object.values(data.errors)[0][0],false);}
      else{show(cform.dataset.error,false);}
    }catch(err){show(cform.dataset.error,false);}
    btn.disabled=false;btn.textContent=cform.dataset.label;
  });
}

/* VIDEOS THAT CAN'T LOAD (missing file, blocked link) get hidden so the image behind them shows */
document.querySelectorAll('video').forEach(v=>{
  const srcs=v.querySelectorAll('source');
  const fail=()=>v.classList.add('failed');
  if(srcs.length)srcs[srcs.length-1].addEventListener('error',fail);
  else if(v.getAttribute('src'))v.addEventListener('error',fail);
});

/* WORLD MAP: hovering a location lights its country and pin */
const wmap=document.querySelector('.world-map-svg');
if(wmap){
  document.querySelectorAll('.g-loc[data-cc]').forEach(loc=>{
    const els=wmap.querySelectorAll('[data-cc="'+loc.dataset.cc+'"]');
    loc.addEventListener('mouseenter',()=>els.forEach(el=>el.classList.add('hl')));
    loc.addEventListener('mouseleave',()=>els.forEach(el=>el.classList.remove('hl')));
  });
}

/* CLIENT GALLERY LIGHTBOX */
const lb=document.getElementById('lightbox');
if(lb){
  const imgs=[...document.querySelectorAll('.cg-img')],pic=lb.querySelector('img');
  let cur=0;
  const show=i=>{cur=(i+imgs.length)%imgs.length;pic.src=imgs[cur].dataset.full;};
  const close=()=>{lb.hidden=true;document.body.style.overflow='';};
  imgs.forEach((b,i)=>b.addEventListener('click',()=>{show(i);lb.hidden=false;document.body.style.overflow='hidden';}));
  lb.querySelector('.lb-close').addEventListener('click',close);
  lb.querySelector('.lb-prev').addEventListener('click',()=>show(cur-1));
  lb.querySelector('.lb-next').addEventListener('click',()=>show(cur+1));
  lb.addEventListener('click',e=>{if(e.target===lb)close();});
  lb.querySelectorAll('.lb-prev,.lb-next').forEach(b=>b.hidden=imgs.length<2);
  document.addEventListener('keydown',e=>{
    if(lb.hidden)return;
    if(e.key==='Escape')close();
    if(e.key==='ArrowLeft')show(cur-1);
    if(e.key==='ArrowRight')show(cur+1);
  });
}
