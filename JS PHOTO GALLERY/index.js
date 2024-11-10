const model = document.createElement('div')
model.id = 'model'
document.body.appendChild(model)

const images = document.querySelectorAll('.img');   

images.forEach(image=>{
    image.addEventListener('click',()=>{
        model.classList.add('active');
        const picture =document.createElement('img');
        picture.src=image.src;
        picture.id="pic"; 
        while (model.firstChild){
            model.removeChild(model.firstChild);
        }
        model.append(picture);
    });
});

model.addEventListener('click',()=>{
    model.classList.remove('active');
});