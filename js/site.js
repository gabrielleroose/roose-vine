function checkDiscount() {
    const now = new Date();
    const minute = now.getMinutes();
    
    if(minute%2 ===1) {
      alert("Congrats! A discount is available");
    }
else {
      alert("Sorry, no discount at the moment. Try again next minute!");
}


}
