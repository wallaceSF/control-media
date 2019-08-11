import React, {Component} from 'react';
import Grid from '@material-ui/core/Grid';
import TextField from '@material-ui/core/TextField';
import Select from "@material-ui/core/Select";
import MenuItem from "@material-ui/core/MenuItem";
import Input from "@material-ui/core/Input";
import FormControl from "@material-ui/core/FormControl";
import InputLabel from "@material-ui/core/InputLabel";
import Button from "@material-ui/core/Button";
import { Redirect } from 'react-router-dom'


export default class MediaDelete extends Component {
   #id = null; 

  constructor(props) {
    super(props);
    this.#id = this.props.match.params.id;
  }

    componentDidMount() { 
        console.log(this.#id);

        fetch(`http://localhost:8100/media/${this.#id}`, {
        method: 'DELETE'
        })
            .then(response => {
                 response.json().then((content) => {
                    if (!response.ok) {
                        throw content;
                    }
                    this.props.history.push(`/`);

                    console.log(content);
                }).catch((errorText) => {
                    console.log(errorText);
                });
            });
    }
        
 

    render() {

        return (
            <React.Fragment>
               
            </React.Fragment>
        );
    }
}
