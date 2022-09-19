/// <reference types="cypress" />
describe("User Can Open Login Page", () => {
    it("Login Page Can Be Open and have correct specification", () => {
        cy.visit("http://localhost:8000/");
        cy.get("h4").should("have.text", "Login");
        cy.get(":nth-child(2) > label").should("have.text", "E-mail");
        cy.get(".control-label").should("have.text", "Password");
        cy.get(".btn").contains("Login").and("be.enabled");
    });

    it("User Can Login", () => {
        cy.visit("http://localhost:8000/");
        cy.get("h4").should("have.text", "Login");
        cy.get(":nth-child(2) > label").should("have.text", "E-mail");
        cy.get(".control-label").should("have.text", "Password");
        cy.get(".btn").contains("Login").and("be.enabled");

        cy.get(":nth-child(2) > .form-control").type("zkoss@example.org");
        cy.get(":nth-child(3) > .form-control").type("password");
        cy.get(".btn").click();
        cy.get("h1").contains("Blank Page");
        cy.get(".navbar-right > :nth-child(3) > .nav-link").click();
        cy.get("form > .dropdown-item").click();
    });

    it("User Cannot Login", () => {
        cy.visit("http://localhost:8000/");
        cy.get("h4").should("have.text", "Login");
        cy.get(":nth-child(2) > label").should("have.text", "E-mail");
        cy.get(".control-label").should("have.text", "Password");
        cy.get(".btn").contains("Login").and("be.enabled");

        cy.get(":nth-child(2) > .form-control").type("random@example.org");
        cy.get(":nth-child(3) > .form-control").type("random");
        cy.get(".btn").click();
        cy.get(".invalid-feedback").contains(
            "These credentials do not match our records."
        );
    });
});
