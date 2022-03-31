const form       = document.querySelector('.search-form')
const inputValue = document.querySelector('.search-value')
const errorMsg   = document.querySelector('.error-message')

form.addEventListener('submit', (e)=>{
    if(inputValue.value == ""){
        e.preventDefault()
        errorMsg.classList.add('error')
    }else if(inputValue.value != ""){
        errorMsg.classList.add('error')
    }
})