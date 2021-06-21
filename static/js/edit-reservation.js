let customerId,
  reservationId,
  firstNameInput,
  lastNameInput,
  addressInput,
  phoneNumberInput,
  dateInput;

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

  if (input === "first_name") {
    firstNameInput = value;
  }

  if (input === "last_name") {
    lastNameInput = value;
  }

  if (input === "address") {
    addressInput = value;
  }

  if (input === "phone_number") {
    phoneNumberInput = value;
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
    if (sibling.children.length) {
      sibling.children[0].contentEditable = "true";
      sibling.children[1].contentEditable = "true";
      sibling.children[0].focus();
    } else {
      sibling.contentEditable = "true";
      if (index === 0) sibling.focus();
    }

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

  console.log(
    customerId,
    reservationId,
    firstNameInput,
    lastNameInput,
    addressInput,
    phoneNumberInput,
    dateInput
  );

  window.location.replace(
    `./reservation_process.php?edit=${customerId}&reservation_id=${reservationId}&first_name=${firstNameInput.trim()}&last_name=${lastNameInput.trim()}&address=${addressInput.trim()}&phone_number=${phoneNumberInput.trim()}&date=${dateInput.trim()}`
  );
};

const initFieldInputs = (
  cus_id,
  res_id,
  firstName,
  lastName,
  address,
  phoneNumber,
  date
) => {
  customerId = cus_id;
  reservationId = res_id;
  firstNameInput = firstName;
  lastNameInput = lastName;
  addressInput = address;
  phoneNumberInput = phoneNumber;
  dateInput = date;
};

const handleEdit = (e, btn) => {
  let customer_id = btn.dataset.customer_id;
  let reservation_id = btn.dataset.reservation_id;
  let firstName = btn.dataset.first_name;
  let lastName = btn.dataset.last_name;
  let address = btn.dataset.address;
  let phoneNumber = btn.dataset.phone_number;
  let date = btn.dataset.date;

  let siblings = getSiblings(btn.parentElement.parentElement);

  siblings.forEach((sibling, index) => {
    if (index === 3) {
      console.log(sibling.textContent);
      sibling.textContent = date;
    }
  });

  let firstNameTemp = firstName;
  let lastNameTemp = lastName;
  let addressTemp = address;
  let phoneNumberTemp = phoneNumber;
  let dateTemp = date;

  setTimeout(() => {
    if (
      firstNameTemp === firstName ||
      lastNameTemp === lastName ||
      addressTemp === address ||
      phoneNumberTemp === phoneNumber ||
      dateTemp === date
    )
      initFieldInputs(
        customer_id,
        reservation_id,
        firstName,
        lastName,
        address,
        phoneNumber,
        date
      );
  }, 100);

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
