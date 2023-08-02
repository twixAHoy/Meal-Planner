import { MealPlanReader } from "./MealPlanReader";
//import { MealPlanWriter } from "./MealPlanWriter";

export class MealPlan {
  constructor() {}

  initialize() {
    this.MealPlanReader = new MealPlanReader();
    //this.MealPlanWriter = new MealPlanWriter();
    this.searchByType();
    this.searchByName();
  }

  //function that is called on click
  searchByType() {
    $(document).on("click", ".meal-type-button", (event) => {
      var mealType = $(event.target).attr("name");
      console.log(mealType);
      this.MealPlanReader.searchByType(mealType)
        .then((data) => {
          // console.log("Received data:", data);
          $(".main-container").html(data); // Update the content with the received data
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    });
  }

  searchByName() {
    $(document).on("keydown", ".search-text-box", (event) => {
      if (event.key === "Enter") {
        var mealName = $(event.target).val();
        this.MealPlanReader.searchByName(mealName)
          .then((data) => {
            $(".main-container").html(data);
          })
          .catch((error) => {
            console.error("Error: ", error);
          });
      }
    });
  }
}
