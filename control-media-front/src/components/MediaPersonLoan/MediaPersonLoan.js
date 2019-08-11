import React, {Component} from 'react';
import Grid from '@material-ui/core/Grid';
import TextField from '@material-ui/core/TextField';
import Select from "@material-ui/core/Select";
import MenuItem from "@material-ui/core/MenuItem";
import Input from "@material-ui/core/Input";
import FormControl from "@material-ui/core/FormControl";
import InputLabel from "@material-ui/core/InputLabel";
import Button from "@material-ui/core/Button";

export default class MediaPersonLoan extends Component {
   #id; 

  constructor(props) {
    super(props);
    this.#id = this.props.match.params.id;
  }
    state = {
        disabled: true,
        status: null,
        title: null,
        description: null,
        type: null,
        person: null,
        allowLoan: null,
        personList: null,
        objectMedia: null,
        objectDataPersonLoan: null
    };

    async componentDidMount() {
        this.checkMediaBorrowed();
        this.getAllPerson();
        await this.getInfoMedia();
    }

    getInfoMedia = async () => {
        const response = await fetch(`http://localhost:8100/media/${this.#id}`);
        const json = await response.json();
        console.log(json);

        await this.setState({objectMedia: json});
    };

    checkMediaBorrowed =  () => {
         fetch(`http://localhost:8100/getDataPersonLoan/${this.#id}`, {
            method: 'GET'
        })
            .then(response => {
                response.json().then((content) => {
                    if (!response.ok) {
                        throw content;
                    }
                    if (content == '') {
                        this.setState({allowLoan: true, disabled: false,});
                    } else {
                        this.setState({allowLoan: false, disabled: true, person: content.person.id});
                    }

                }).catch((errorText) => {
                    console.log(errorText);
                });
            });
    };

    getAllPerson() {
        fetch(`http://localhost:8100/person/`, {
            method: 'GET'
        })
            .then(response => {
                response.json().then((content) => {
                    if (!response.ok) {
                        throw content;
                    }
                    this.setState({personList: content});

                }).catch((errorText) => {
                    console.log(errorText);
                });
            });
    }

    generateListPersonMenuItem(){
        if (this.state.personList !== null) {
            return this.state.personList.map(user => (
                <MenuItem value={user.id}>{user.name}</MenuItem>
            ));
        }
    }

    handleChangePerson = event => {
        this.setState({person: event.target.value});
    };

    handleSubmitReturnMidia = async event => {
        var dataObject = JSON.stringify({
            "person": this.state.person,
            "media": this.#id
        });

        await fetch('http://localhost:8100/media-person-loan/update/', {
            method: 'PUT',
            body: dataObject
        })
            .then(response => {
                response.json().then((content) => {
                    if (!response.ok) {
                        throw content;
                    }
                    this.props.history.push(`/`);
                }).catch((errorText) => {
                    console.log(errorText);
                });
            });

    };

    buttonReturnMidia() {
        if(this.state.allowLoan === false) {
            return (
                <Grid container xs={12} sm={12} spacing={3} alignItems="center"
                          justify="center" direction="column">
                    <Button style={{margin: 20}} onClick={() => this.handleSubmitReturnMidia()} type="button" variant="contained" color="primary">
                        Devolver Midía
                    </Button>
                </Grid>
            );
        }
    }

    buttonAllowLoan() {
        if(this.state.allowLoan === true) {
            return (
                <Button style={{margin: 20}} type="submit" variant="contained" color="primary">
                    Solicitar Emprestimo
                </Button>
            );
        }
    }

    handleSubmit = async event => {
        event.preventDefault();

        for (let element of event.target.elements) {
            await this.setState({[element.name]: element.value});
        }

        var dataObject = JSON.stringify({
            "person": this.state.person,
            "media": this.#id
        });

        await fetch('http://localhost:8100/media-person-loan/create/', {
            method: 'POST',
            body: dataObject
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
    };

    render() {
        return (
            <React.Fragment>
                <form onSubmit={this.handleSubmit}>
                    <Grid container xs={12} sm={12} spacing={3} alignItems="center" justify="center" direction="column">
                        <Grid style={{width: '50%'}}>
                           
                            <TextField
                                required
                                id="title"
                                name="title"
                                label="Título"
                                fullWidth
                                disabled={true}
                                autoComplete="title"
                                value={this.state.objectMedia == null ? '' : this.state.objectMedia.title}
                            />
                        </Grid>
                        <Grid style={{width: '50%'}}>
                            <TextField
                                required
                                id="description"
                                name="description"
                                label="Descrição"
                                fullWidth
                                autoComplete="description"
                                multiline={true}
                                disabled
                                rows={3}
                                rowsMax={6}
                                value={this.state.objectMedia == null ? '' : this.state.objectMedia.description}
                            />
                        </Grid>
                        <Grid style={{width: '50%', padding:20}}>
                            <InputLabel htmlFor="type">Tipo</InputLabel>
                            <Select style={{width: '30%'}}
                                    disabled
                                    onChange={this.handleChangeType}
                                    input={<Input name="type" id="type" value={this.state.objectMedia == null ? '' : this.state.objectMedia.type.id}/>}
                            >
                                <MenuItem value=""><em>selecione um tipo</em></MenuItem>
                                <MenuItem value={1}>DVD</MenuItem>
                                <MenuItem value={2}>Livro</MenuItem>
                                <MenuItem value={3}>CD</MenuItem>
                            </Select>
                        </Grid>
                        <Grid style={{width: '50%', padding: "10 10 10 10"}}>
                            <InputLabel style={{float:"right"}}><b>Essa mídia esta {this.state.allowLoan === true ? 'Disponível' : 'Emprestada'}</b></InputLabel>
                        </Grid>

                        <Grid style={{width: '50%', padding: 0}} >
                            <FormControl style={{width: '30%'}} disabled={this.state.disabled}>
                                <InputLabel required htmlFor="person">Pessoa responsável</InputLabel>                               
                                <Select
                                    required
                                    onChange={this.handleChangePerson}
                                    input={<Input name="person" id="person" value={this.state.person == null ? '' : this.state.person}/>}
                                >
                                    <MenuItem value="">
                                        <em>None</em>
                                    </MenuItem>
                                    {this.generateListPersonMenuItem()}
                                </Select>
                            </FormControl>
                        </Grid>
                        {this.buttonAllowLoan()}
                        {this.buttonReturnMidia()}
                    </Grid>
                </form>
            </React.Fragment>
        );
    }
}
