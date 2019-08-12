import React, {Component} from 'react';
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
                    alert(errorText);
                    this.props.history.push(`/`);
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
