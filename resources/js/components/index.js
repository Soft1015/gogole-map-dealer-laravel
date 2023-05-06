import React from "react";
import ReactDOM from "react-dom";
import Dashboard from "./dashboard";
function App() {
  return (
    <div className="App">
      <Dashboard />
    </div>
  );
}

if (document.getElementById('root')) {
  ReactDOM.render(<App />, document.getElementById('root'));
}
