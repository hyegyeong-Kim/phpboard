//수정버튼 찾기
var dat_edit_bt = document.querySelectorAll('.dat_edit_bt');
//삭제버튼 착기
var dat_delete_bt = document.querySelectorAll('.dat_delete_bt');
//dat_edit 찾기
var dat_edit = document.querySelectorAll('.dat_edit');
//dat_delete 찾기
var dat_delete = document.querySelectorAll('.dat_delete');

//각각 수정버튼 클릭 했을 경우, 
for(let i = 0; i<dat_edit_bt.length; i++){
  dat_edit_bt[i].addEventListener('click', function(){
    dat_edit[i].style.visibility = "visible";
  });
  dat_delete_bt[i].addEventListener('click', function(){
    dat_delete[i].style.visibility = "visible";
  })
}
//해당하는 dat_edit의 visibility가 visible이 된다.
//각각삭제버튼 클릭 했을 경우, 
//해당하는 dat_delete의 visiblity가 visible이 된다.