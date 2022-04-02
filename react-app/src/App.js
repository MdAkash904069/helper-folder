import React from "react";
import {BrowserRouter as Router, Route} from "react-router-dom";

import Home from './components/Home';
import About from './components/About';
import Contact from './components/Contact';
import Follow from './components/Follow';

function App() {
  return (
    
      <Router>
        <Route exact path="/" component={Home} />
        <Route exact path="/about" component={About} />
        <Route exact path="/contact" component={Contact} />
        <Route exact path="/follow" component={Follow} />
      </Router>
    
  );
}

export default App;
