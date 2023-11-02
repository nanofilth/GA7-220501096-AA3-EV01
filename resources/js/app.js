import './bootstrap';

const focusElement = () => {
    const formElements = document.querySelectorAll("input:not([type='hidden']):not([disabled='disabled']), textarea, select");
    if (formElements.length) {
        formElements[0].focus();
    }
}

const addNewRow = (e) => {
    operateButton('bg-teal-500');
    showForm('s', 0);
    focusElement();
}

const editRow = (target) => {
    operateButton('bg-indigo-500');
    const rowData = document.querySelector('.' + target).dataset;
    showForm('u', rowData['id']);
    for (const key in rowData) {
        let element = document.getElementById(key);
        operateElement(element, rowData[key]);
    }
    focusElement();
}

const showForm = (type, _id) => {
    const _form = document.querySelector('.form-inline-crud')
    _form.reset();
    const inputElements = _form.querySelectorAll("input, select, textarea");
    inputElements.forEach(function (element) {
        element.removeAttribute("disabled");
    });
    const _methodInput = _form.querySelector("input[name='_method']");
    const _methodValue = type == 's' ? 'POST' : 'PUT';
    _methodInput.value = _methodValue;
    const targetAttributeValue = _form.getAttribute("action").split('/');
    const urlTarget = type == 's' ? targetAttributeValue[0] : targetAttributeValue[0]+'/'+_id;
    _form.setAttribute('action',urlTarget);
    _form.classList.remove('hidden');
}

const operateElement = (element, value) => {
    if (element && element.tagName === "INPUT") {
        const inputType = element.dataset["realtype"];
        const inputName = element.getAttribute("name");
        switch (inputType) {
            case 'checkbox':
                const _element = document.getElementById('_checkbox');
                if (value == 1) {
                    _element.value = 1;
                    _element.checked = true;
                    _element.setAttribute("checked", "checked");
                }else{
                    _element.value = 0;
                    _element.checked = false;
                    _element.removeAttribute("checked");
                }
                break;
            default:
                element.value = value;
                break;
        }
        element.value = value;
        if (inputName === 'id') {
            element.setAttribute("disabled", "disabled");
        }
    }
}

const operateButton = (_cls) => {
    const button = document.getElementById('submit-form');
    const list = button.className.split(' ');
    for (const className of list) {
        if (className.startsWith("bg-")) {
            button.classList.remove(className);
        }
    }
    button.classList.add(_cls);
}

const validateCheckbox = () => {
    const element = document.getElementById('_checkbox');
    const realValue = element.checked ? 1 : 0;
    document.getElementById(element.dataset['target']).value = realValue;    
}

document.querySelectorAll('.add-new').forEach((element, key) => element.addEventListener('click', addNewRow));
document.querySelectorAll('.edit-row').forEach((element, key) => element.addEventListener('click', () => editRow(element.dataset['target'])));
document.getElementById('_checkbox').addEventListener('click', validateCheckbox);