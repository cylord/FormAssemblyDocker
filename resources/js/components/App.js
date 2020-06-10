import React, { Component } from "react";
import ReactDOM from "react-dom";
import Forms from "./Forms";
import axios from "axios";

class App extends Component {
    constructor() {
        super();
        this.state = {
            forms: []
        };
    }
    async componentDidMount() {
        const res = await axios.get("http://localhost:8100/forms");

        this.setState({ forms: res.data });

        //console.log(this.state.forms.Forms);
    }

    render() {
        return (
            <div className="App">
                <div className="container">
                    <Forms forms={this.state.forms.Forms} />
                </div>
            </div>
        );
    }
}

export default App;

if (document.getElementById("root")) {
    ReactDOM.render(<App />, document.getElementById("root"));
}
