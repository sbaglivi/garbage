const deleteForm = document.getElementById("deleteForm");
const idInput = deleteForm.querySelector('input');

// idInput.addEventListener("change", (e) => {
//   deleteForm.action = `/delete/${idInput.value}`;
// })


deleteForm.addEventListener("submit", async (e) => {
  e.preventDefault();
  const id = idInput.value;
  let response = await fetch(`/delete/${id}`, {
    method: "DELETE",
    redirect: "follow"
  });
  console.log(response);
  let json = await response.json();
  window.location.href = json.redirect;
})