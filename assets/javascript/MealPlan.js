import { MealPlanReader } from "./MealPlanReader";
import { MealPlanWriter } from "./MealPlanWriter";

export class MealPlan {
  constructor() {}

  initialize() {
    this.MealPlanReader = new MealPlanReader();
    this.MealPlanWriter = new MealPlanWriter();
  }

  //function that is called on click
  searchByType() {
    let nativeClass = this;
    $(".meal-type-button").on("click", function (event) {
      event.preventDefault();
      var mealType = $(this).attr("name");
      //get element by class name
      let checkElement = document.getElementsByClassName("meal-container");
      this.MealPlanReader.searchByType(mealType).then((data) => {
        //find all elements where class != mealType and hide
        if (checkElement.classList.contains(mealType)) {
          checkElement.css("display", "block");
        } else {
          checkElement.css("display", "none");
        }
      });
    });
  }
}
