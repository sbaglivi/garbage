const createTable = () => {
  let table = document.createElement("table");
  let tr = document.createElement("tr");
  let th;
  th = document.createElement("th");
  th.textContent = "ID";
  tr.append(th);
  th = document.createElement("th");
  th.textContent = "Type";
  tr.append(th);
  th = document.createElement("th");
  th.textContent = "Start";
  tr.append(th);
  th = document.createElement("th");
  th.textContent = "End";
  tr.append(th);
  th = document.createElement("th");
  th.textContent = "Weekday";
  tr.append(th);
  table.append(tr);
  let tbody = document.createElement("tbody");
  table.append(tbody);
  return [table, tbody];
}
const updateTbody = (rows) => {
  tbody.innerHTML = "";
  let tr, td;
  rows.forEach(row => {
    tr = document.createElement("tr");
    Object.values(row).forEach(property => {
      td = document.createElement("td");
      td.textContent = property;
      tr.append(td);
    });
    tbody.append(tr);
  })
}
async function getPickups() {
  let response = await fetch("/api");
  let data = await response.json();
  updateTbody(data.data);
}
const endtimeGreaterStarttime = (formData) => {
  let startTime = formData.get("startTime");
  startTime = +startTime.replace(":", "");
  let endTime = formData.get("endTime");
  endTime = +endTime.replace(":", "");
  console.log(`startTime: ${startTime} - endTime: ${endTime}`);
  return endTime > startTime
}
const addForm = document.getElementById("addForm");
const deleteForm = document.getElementById("deleteForm");
const insertMessage = document.getElementsByClassName("insertMessage")[0];
const deleteId = deleteForm.querySelector("input");
displayError = (p, text) => {
  p.style.display = "block";
  p.classList.remove("success");
  p.classList.add("error");
  p.textContent = text;
}
displaySuccess = (p, text) => {
  p.style.display = "block";
  p.classList.remove("error");
  p.classList.add("success");
  p.textContent = text;
}
addForm.addEventListener("submit", async (e) => {
  e.preventDefault();
  let formData = new FormData(addForm);
  if (!endtimeGreaterStarttime(formData)) {
    displayError(insertMessage, "The pickup end time must be greater than the start time");
    return;
  }
  let response = await fetch("/api/pickups", {
    method: "POST",
    body: formData
  })
  if (!response.ok) {
    error = await response.json();
    displayError(insertMessage, error.error);
    return;
  }
  console.log(...formData);
  displaySuccess(insertMessage, `Insert of pickup was successful!`);

  getPickups();
})
const deleteMessage = document.getElementsByClassName("deleteMessage")[0];
deleteForm.addEventListener("submit", async (e) => {
  e.preventDefault();
  let id = deleteId.value;
  let response = await fetch(`/api/delete/${id}`, {
    method: "DELETE"
  })
  if (!response.ok) {
    let error = await response.json();
    displayError(deleteMessage, error.error);
    return;
  }
  displaySuccess(deleteMessage, `Successfully deleted pickup with id ${id}`);
  deleteId.value = "";
  getPickups()
})
const updateForm = document.getElementById("updateForm");
let updateMessage = document.getElementsByClassName("updateMessage")[0];
stringFromFormData = (formData) => {
  let dataString = "";
  for (let entry of formData.entries()) {
    dataString += `${entry[0]}=${entry[1]}&`
  }
  dataString = dataString.slice(0, -1);
  return dataString;
}
updateForm.addEventListener("submit", async (e) => {
  e.preventDefault();
  formData = new FormData(updateForm);
  let dataString = stringFromFormData(formData);
  let response = await fetch("/api/pickups", {
    method: "PUT",
    body: dataString
  })
  if (!response.ok) {
    let error = await response.json();
    displayError(updateMessage, error.error);
    return;
  }
  displaySuccess(updateMessage, `Updated pickup with id ${formData.get("id")} successfully!`);
  getPickups();
})
let [table, tbody] = createTable();
document.body.append(table);
getPickups()