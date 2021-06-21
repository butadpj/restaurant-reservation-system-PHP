let idInput, nameInput, contactInput, dateInput;

let isEditing = false;

const editButtons = document.querySelectorAll(".action-buttons .edit-btn");

const getSiblings = (e) => {
  // for collecting siblings
  let siblings = [];
  // if no parent, return no sibling
  if (!e.parentNode) {
    return siblings;
  }
  // first child of the parent node
  let sibling = e.parentNode.firstChild;

  // collecting siblings
  while (sibling) {
    if (sibling.nodeType === 1 && sibling !== e) {
      siblings.push(sibling);
    }
    sibling = sibling.nextSibling;
  }
  return siblings;
};

const handleInput = (e) => {
  let input = e.target.getAttribute("name");
  let value = e.target.textContent;

  if (input === "name") {
    nameInput = value;
  }

  if (input === "contact") {
    contactInput = value;
  }

  if (input === "date") {
    dateInput = value;
  }
};

const makeFieldsEditable = (btn) => {
  isEditing = true;
  btn.innerHTML = "Save";
  let siblings = getSiblings(btn.parentElement.parentElement);

  siblings.forEach((sibling, index) => {
    sibling.contentEditable = "true";
    if (index === 0) sibling.focus();

    sibling.addEventListener("input", (e) => handleInput(e));
  });
};

const saveEditedFields = (btn) => {
  isEditing = false;
  btn.innerHTML = "Edit";

  let siblings = getSiblings(btn.parentElement.parentElement);

  siblings.forEach((sibling) => {
    sibling.contentEditable = "false";
  });

  window.location.replace(
    `./reservation_process.php?edit=${idInput}&name=${nameInput.trim()}&contact=${contactInput.trim()}&date=${dateInput.trim()}`
  );
  console.log(idInput, nameInput, contactInput, dateInput);
};

const initFieldInputs = (id, name, contact, date) => {
  idInput = id;
  nameInput = name;
  contactInput = contact;
  dateInput = date;
};

const handleEdit = (e, btn) => {
  let id = btn.dataset.id;
  let name = btn.dataset.name;
  let contact = btn.dataset.contact;
  let date = btn.dataset.date;

  let siblings = getSiblings(btn.parentElement.parentElement);

  siblings.forEach((sibling, index) => {
    if (index === 2) console.log(sibling.textContent);
    sibling.textContent = date;
  });

  let idTemp = id;
  let nameTemp = name;
  let contactTemp = contact;
  let dateTemp = date;

  setTimeout(() => {
    if (
      idTemp === id ||
      nameTemp === name ||
      contactTemp === contact ||
      dateTemp === date
    )
      initFieldInputs(id, name, contact, date);
  }, 100);

  //   initFieldInputs(id, name, contact, date);

  if (!isEditing) {
    makeFieldsEditable(btn);
  } else {
    saveEditedFields(btn);
  }
};

window.addEventListener("load", () => {
  editButtons.forEach((btn) => {
    btn.addEventListener("click", (e) => handleEdit(e, btn));
  });
});
