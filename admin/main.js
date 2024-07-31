
const ipnElement = document.querySelector('#ipnPassword')
const btnElement = document.querySelector('#btnPassword')


btnElement.addEventListener('click', function() {

  const currentType = ipnElement.getAttribute('type')

  ipnElement.setAttribute(
    'type',
    currentType === 'password' ? 'text' : 'password'
  )
  
})
function  onclickfn() {
document.location.href ="./product_list.php";
}
