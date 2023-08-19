const newItemPopUp = document.getElementById('addPopup');
const addItemBTN = document.getElementById('newItem');
const clsItemBTN = document.getElementById('clsAddItem');
const tittleTextinpt = document.getElementById('tittleName');
const imageInput = document.getElementById('imageInput');
const fotoNama = document.getElementById('foto_nama');

addItemBTN.addEventListener('click', () => {
    newItemPopUp.classList.remove('hidden');
})

clsItemBTN.addEventListener('click', ()=> {
    newItemPopUp.classList.add('hidden');
});

imageInput.addEventListener('change', function() {
    if (this.files && this.files.length > 0) {
      fotoNama.textContent = this.files[0].name;
    } else {
      fotoNama.textContent = 'Attach your files here';
    }
  });