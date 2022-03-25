const constraints = {
    name: {
        presence: {allowEmpty: false}
    },
    email: {
        presence: {allowEmpty: false},
        email: true
    },
    message: {
        presence: {allowEmpty: false}
    }
};

const form = document.querySelector('.form')

form.addEventListener('submit', (e)=>{
    const formValues = {
        name: form.elements.name.value,
        email: form.elements.email.value,
        message: form.elements.message.value
    }

    const errors = validate(formValues, constraints)
    const errorMsg = document.querySelector('.error-message')
    if(errors){
        e.preventDefault()
        const errorMessage = Object
        .values(errors)
        .map(function (fieldValues) { return fieldValues.join(', ')})
        .join("\n");
        errorMsg.innerHTML = errorMessage
    }

})

