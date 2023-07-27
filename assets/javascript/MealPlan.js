import { MealPlanReader } from "./MealPlanReader";
//import { MealPlanWriter } from "./MealPlanWriter";

export class MealPlan {
  constructor() {}

  initialize() {
    this.MealPlanReader = new MealPlanReader();
    //this.MealPlanWriter = new MealPlanWriter();
    this.searchByType();
  }

  //function that is called on click
  searchByType() {
    $(".meal-type-button")
      .off("click")
      .on("click", (event) => {
        var mealType = $(event.target).attr("name");
        console.log(mealType);
        let checkElement = document.getElementsByClassName("meal-container");

        for (let i = 0; i < checkElement.length; i++) {
          const element = checkElement[i];
          if (!element.classList.contains(mealType)) {
            element.style.display = "none";
          }
        }
      });
  }
}
