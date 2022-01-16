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
let [table, tbody] = createTable();
document.body.append(table);
const searchForm = document.getElementById("searchForm");
const queryStringFromData = (formData) => {
  let queryString = "";
  let firstFilter = true;
  for (let entry of formData.entries()) {
    if (entry[1] !== "") {
      if (firstFilter) {
        queryString += `?${entry[0]}=${entry[1]}`;
        firstFilter = false;
        continue
      }
      queryString += `&${entry[0]}=${entry[1]}`;
    }
  }
  return queryString;
}
searchForm.addEventListener("submit", async (e) => {
  e.preventDefault()
  let formData = new FormData(searchForm);
  let queryString = queryStringFromData(formData);
  let response = await fetch(`/api/search${queryString}`);
  if (!response.ok) {
    console.log("There was a problem with the search");
    return;
  }
  let data = await response.json();
  updateTbody(data.data);
})
const weekdays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
const d = new Date();
let day = weekdays[d.getDay()];
getTodaysData = async () => {
  let response = await fetch(`/api/search?weekday=${day}`);
  if (!response.ok) {
    console.log("There was a problem with the search");
    return;
  }
  let data = await response.json();
  updateTbody(data.data);
}
todayButton.addEventListener("click", getTodaysData);