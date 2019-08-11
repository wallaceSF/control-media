import React from 'react';
import ReactDOM from 'react-dom';
import {BrowserRouter as Router, Route} from 'react-router-dom'

import './index.css';
import App from './App';
import * as serviceWorker from './serviceWorker';
import MenuBar from "./components/MenuBar/MenuBar";
import Media from "./components/Media/Media";
import MediaDelete from "./components/Media/MediaDelete";
import MediaPersonLoan from "./components/MediaPersonLoan/MediaPersonLoan";
import Person from "./components/Person/Person";

ReactDOM.render(
    <Router>
        <MenuBar/>
        <Route path="/" exact={true} component={App}/>
        <Route path="/media-update/:id" exact={true} component={Media}/>
        <Route path="/media-create" exact={true} component={Media}/>
        <Route path="/media-delete/:id" exact={true} component={MediaDelete}/>
        <Route path="/media-loan/:id" exact={true} component={MediaPersonLoan}/>
        <Route path="/person-create" exact={true} component={Person}/>
    </Router>
    , document.getElementById('root')
);

serviceWorker.unregister();
