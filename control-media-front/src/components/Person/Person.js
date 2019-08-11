import React, {Component} from 'react';
import Grid from '@material-ui/core/Grid';
import TextField from '@material-ui/core/TextField';
import Button from "@material-ui/core/Button";

export default class Person extends Component {
    state = {
        name: true,
        dateOfBirth: null
    };

    handleSubmit = async event => {
        event.preventDefault();

        for (let element of event.target.elements) {
            await this.setState({[element.name]: element.value});
        }

        var dataSend = JSON.stringify({
            "name": this.state.name,
            "dateOfBirth": this.state.dateOfBirth
        });

        await fetch('http://localhost:8100/person/create/', {
            method: 'POST',
            body: dataSend
        })
            .then(response => {
                response.json().then((content) => {
                    if (!response.ok) {
                        throw content;
                    }
                  this.props.history.push(`/`);
                }).catch((errorText) => {
                    alert(errorText);
                });
            });

      //  console.log(data);
        console.log(this.state);
    };

    render() {

        return (
            <React.Fragment>
                <form onSubmit={this.handleSubmit}>
                    <Grid container xs={12} sm={12} spacing={3} alignItems="center" justify="center" direction="column">
                        <Grid style={{width: '50%'}}>
                            <TextField
                                required
                                id="name'"
                                name="name"
                                label="Nome"
                                fullWidth
                                autoComplete="name"
                            />
                        </Grid>
                        <Grid style={{width: '50%'}}>                
                            <TextField
                                    id="dateOfBirth"
                                    name="dateOfBirth"
                                    label="Data de Nascimento"
                                    type="date"                                                                       
                                    InputLabelProps={{
                                      shrink: true,
                                    }}
                                  />
                        </Grid>

                        <Button type="submit" variant="contained" color="primary">
                            Salvar
                        </Button>
                    </Grid>
                </form>
            </React.Fragment>
        );
    }
}
