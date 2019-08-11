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


export default class Media extends Component {
   #id = null; 

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
        objectDataPersonLoan: null
    };

    async componentDidMount() { 
        await this.getInfoMedia();
    }

    getInfoMedia = async () => {
        if(this.#id == null){
            return;
        }

        const response = await fetch(`http://localhost:8100/media/${this.#id}`);
        const json = await response.json();
        console.log(json);

        await this.setState({title: json.title, description: json.description, type: json.type.id});
    };


    handleChangeType = event => {
        this.setState({type: event.target.value});
    };

    updateValuesForm = async event =>{
        await this.setState({[event.target.name]: event.target.value});
    }

    handleSubmit = async event => {
        event.preventDefault();

        for (let element of event.target.elements) {
            await this.setState({[element.name]: element.value});
        }

        if(this.#id == null){
             var dataObject = JSON.stringify({
            "title": this.state.title,
            "description": this.state.description,
            "type": this.state.type
        });

        await fetch('http://localhost:8100/media/create/', {
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
                    console.log(errorText);
                });
            });
            return;
        }
        
        var dataObject = JSON.stringify({
            "title": this.state.title,
            "description": this.state.description,
            "type": this.state.type,
            "id": this.#id
        });

        await fetch('http://localhost:8100/media/update/', {
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

    render() {

        return (
            <React.Fragment>
                <form onChange={this.updateValuesForm} onSubmit={this.handleSubmit}>
                    <Grid container xs={12} sm={12} spacing={3} alignItems="center" justify="center" direction="column">
                        <Grid style={{width: '50%'}}>
                            <TextField
                                required
                                id="title"
                                name="title"
                                label="Título"
                                fullWidth
                                autoComplete="title"
                                value={this.state.title == null ? '' : this.state.title}
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
                                value={this.state.description == null ? '' : this.state.description}
                                multiline={true}
                                rows={3}
                                rowsMax={6}
                            />
                        </Grid>  
                        <Grid style={{width: '50%', padding: 10}}>
                            <InputLabel htmlFor="type">Tipo</InputLabel>
                            <Select style={{width: '30%'}}
                                    onChange={this.handleChangeType}
                                 input={<Input name="type" id="type" value={this.state.type == null ? '' : this.state.type}/>}
                            >
                                <MenuItem value=""><em>selecione um tipo</em></MenuItem>
                                <MenuItem value={2}>DVD</MenuItem>
                                <MenuItem value={3}>Livro</MenuItem>
                                <MenuItem value={1}>CD</MenuItem>
                            </Select>
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
